<?php

class M_notifikasi extends MY_Model {

    function pengaduan($id) {
        $this->db->select('fnc.id, fnc.id_complaintment, fcf.url_file, fc.title AS title_pengaduan, fnc.message, fnc.created_at AS date'); //JUDUL, PESAN
        $this->db->where('fc.id_fisherman', $id);
        $this->db->join('fisherman_complaintment fc', 'fnc.id_complaintment=fc.id');
        $this->db->join('fisherman_complaintment_files fcf', 'fc.id=fcf.id_fisherman_complaintment', 'left');
        $this->db->order_by('fnc.id', 'DESC');
        $this->db->group_by('fnc.id');
        $result = $this->db->get('fisherman_notification_complaintment fnc')->result_array();
        if (empty($result)) {
            return 'no_data';
        } else {
            foreach ($result as $k => $r) {
                $r['url_file'] = base_url('upload/pengaduan/') . $r['url_file'];
                $r['title'] = 'Pengaduan anda ' . $r['message'];
                $r['message'] = 'Pengaduan anda "' . $r['title_pengaduan'] . '" ' . $r['message'];
                $result[$k] = $r;
            }
            return $result;
        }
    }

    function komentar($input) {
        $this->db->select('fp.id as id_post, f.id, f.username');
        $this->db->where('fp.id', $input['id_post']);
        $this->db->join('fisherman f', 'f.id=fp.id_fisherman');
        $result = $this->db->get('fisherman_post fp')->row_array();
        $title = $result['username'] . ' mengomentari status anda';
        $message = $result['username'] . ' :"' . $input['komentar'] . '"';
        $this->send_notification($result['id'], $title, $message);
        $this->db->set('type', 'comment');
        $this->db->set('id_fisherman_notif', $result['id']);
        $this->db->set('id_fisherman_action', $input['id_fisherman']);
        $this->db->set('id_post', $result['id_post']);
        $this->db->set('title', $title);
        $this->db->set('message', $message);
        $this->db->insert('fisherman_notification_social_media');
    }

    function like($input) {
        $this->db->select('f.id, f.username, fp.caption');
        $this->db->where('fp.id', $input['id_post']);
        $this->db->join('fisherman f', 'f.id=fp.id_fisherman');
        $result = $this->db->get('fisherman_post fp')->row_array();
        $this->db->where('type', 'like');
        $this->db->where('id_fisherman_notif', $result['id']);
        $this->db->where('id_fisherman_action', $input['id_fisherman']);
        $this->db->where('id_post', $input['id_post']);
        $count = $this->db->count_all_results('fisherman_notification_social_media');
        if ($count == 0) {
            $title = $result['username'] . ' menyukai postingan anda';
            $message = $result['username'] . ' menyukai postingan anda "' . $result['caption'] . '"';
            $this->send_notification($result['id'], $title, $message);
            $this->db->set('type', 'like');
            $this->db->set('id_fisherman_notif', $result['id']);
            $this->db->set('id_fisherman_action', $input['id_fisherman']);
            $this->db->set('id_post', $input['id_post']);
            $this->db->set('title', $title);
            $this->db->set('message', $message);
            return $this->db->insert('fisherman_notification_social_media');
        }
        return true;
    }

    function follow($input) {
        //CHECK REDUNDANT
        $this->db->where('id', $input['id_follower']);
        $result = $this->db->get('fisherman f')->row_array();
        $title = $result['username'] . ' mengikuti anda';
        $this->send_notification($input['id_fisherman'], $title, '');
        $this->db->set('type', 'follow');
        $this->db->set('id_fisherman_notif', $input['id_fisherman']);
        $this->db->set('id_fisherman_action', $input['id_follower']);
        $this->db->set('title', $title);
        return $this->db->insert('fisherman_notification_social_media');
    }

    function sosial_media($input) {
        $this->db->select('fn.*, f.url_photo, f.username, fpf.url_file');
        $this->db->where('fn.id_fisherman_notif', $input['id_user']);
        $this->db->join('fisherman f','f.id= fn.id_fisherman_action');
        $this->db->join('fisherman_post fp','fp.id=fn.id_post', 'left');
        $this->db->join('fisherman_post_files fpf','fp.id=fpf.id_fisherman_post','left');
        $this->db->group_by('fn.id');
        $result = $this->db->get('fisherman_notification_social_media fn')->result_array();
        foreach ($result as $k => $r) {
            $r['url_photo']= base_url('upload/profil/').$r['url_photo'];
            $r['url_file']= base_url('upload/profil/').$r['url_file'];
            $result[$k] = $r;
        }
        return empty($result)?'no_data':$result;
    }

    private function send_notification($userId, $title, $message) {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $headers = array(
            //authorizationkey : kunci server cloud messaging -> cara mendapatkannya pergi console.firebase.google.com
            'Authorization:key = AAAAjkAyl2g:APA91bENJ2Vo6pP4-wGu4GykBFhEf31bxyqAI7iZYTpohEX_Q9QQMM0-qaZ_--OJnWIercO69LBR2ij3huXkmG4QaOqzJEL_djSHGTZvfwdKS9LZeF4xPnLMbXa5qv-H2klLe7WMyur6',
            'Content-Type: application/json'
        );
        //yang akan tampil di notifikasi android
        $notification = array(
            'title' => $title,
            'body' => $message,
            'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
            'sound' => "default"
        );
        //bisa digunakan untuk membawa data dari database, seperti membawa parameter user_id
        $data = array(
            'data_1' => "data_1",
            'data_2' => "data_2",
            'data_3' => "data_3",
            'data_4' => "data_4"
        );
        $this->db->where('id', $userId);
        $result = $this->db->get('fisherman')->row_array();
//        die(print_r($result));
        $fields = array(
            // to : adalah token firebase tujuan untuk hp android yang akan dikirimkan notifikasi
            'to' => $result['mobile_token'],
            'priority' => 'high',
            'notification' => $notification,
            'data' => $data
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            return 'Curl failed: ' . curl_error($ch);
        } else {
            return TRUE;
        }
//        curl_close($ch);
    }

}

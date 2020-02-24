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
        $this->db->where('id', $input['id_post']);
        $result=$this->db->get('fisherman_post')->row_array();
        $this->db->set('type', 'comment');
        $this->db->set('id_fisherman_notif', $result['id_fisherman']);
        $this->db->set('id_fisherman_action', $input['id_fisherman']);
        $this->db->set('id_post', $input['id_post']);
        $this->db->insert('fisherman_notification_social_media');
    }

}

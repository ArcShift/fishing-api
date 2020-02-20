<?php

class M_notifikasi extends MY_Model {

    function pengaduan($id) {
        $this->db->select('fnc.id, fnc.id_complaintment, fcf.url_file, fc.title, fnc.message, fnc.created_at AS date'); //JUDUL, PESAN
        $this->db->where('fc.id_fisherman', $id);
        $this->db->join('fisherman_complaintment fc', 'fnc.id_complaintment=fc.id');
        $this->db->join('fisherman_complaintment_files fcf', 'fc.id=fcf.id_fisherman_complaintment', 'left');
        $this->db->group_by('fnc.id');
        $result = $this->db->get('fisherman_notification_complaintment fnc')->result_array();
        if (empty($result)) {
            return 'no_data';
        } else {
            foreach ($result as $k => $r) {
                $title = $r['title'];
                $r['title'] = 'Pengaduan anda ' . $r['message'];
                $r['message'] = 'Pengaduan anda "' . $title . '" ' . $r['message'];
                $result[$k] = $r;
            }
            return $result;
        }
    }

}

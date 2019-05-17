<?php 

class User_model
{
    private $nama = 'Ivan Restu Alfiansyah';
    private $umur = '23';
    private $pekerjaan = 'Mahasiswa';

    public function getUser()
    {
        return $this->nama;
        return $this->umur;
        return $this->pekerjaan;
    }
}
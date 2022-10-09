<?php

namespace App\Traits;

/**
 * 
 */
trait FakultasTrait
{
    public function listFakultas()
    {
        return [
           [
                'id' => 1,
                'name' => 'Fakultas Hukum'
           ],

           [
                'id' => 2,
                'name' => 'Fakultas Ekonomika dan Bisnis'
           ],

           [
                'id' => 3,
                'name' => 'Fakultas Teknik'
           ],
           [
                'id' => 4,
                'name' => 'Fakultas Kedokteran'
           ],
           [
                'id' => 5,
                'name' => 'Fakultas Peternakan dan Pertanian'
           ],
           [
                'id' => 6,
                'name' => 'Fakultas Ilmu Budaya'
           ],
           [
                'id' => 7,
                'name' => 'Fakultas Ilmu Sosial dan Politik	'
           ],
           [
                'id' => 8,
                'name' => 'Fakultas Kesehatan Masyarakat'
           ],
           [
                'id' => 9,
                'name' => 'Fakultas Sains dan Matematika'
           ],
           [
                'id' => 10,
                'name' => 'Fakultas Perikanan dan Ilmu Kelautan'
           ],
           [
                'id' => 11,
                'name' => 'Fakultas Psikologi'
           ],
        ];
    }

    public function findNameFakultas($id)
    {
        $fk = $this->listFakultas();
        foreach ($fk as $val) {
            if ($val['id'] == $id) {
                return $val['name'];
            }
        }
        return null;
    }
}

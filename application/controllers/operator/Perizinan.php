<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perizinan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //Codeigniter : Write Less Do More
        if($this->session->userdata('jenis_user') != "Operator"
          && $this->session->userdata('logged_id') != TRUE) {
          $this->session->set_flashdata('msg', 'Oppss! Anda harus LogIn sebagai Operator');

          redirect(base_url('login'));
        }
        $this->load->model('Perizinan_model');
        $this->load->library('Pdf');
    }

    public function index() {
        $data['title'] = 'Perizinan';
        $data['breadcrumb'] = '<li> <a href = "'. base_url('operator/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Perizinan</li>';
        $data['perizinan'] = $this->Perizinan_model->getAllPerizinan();

        $this->template->load('layout/static', 'operator/perizinan', $data);
    }

    public function daftarperizinan($status_perizinan) {

      $status = "";
      if($status_perizinan == "dalamproses") {
        $status = "Dalam Proses";
      } elseif ($status_perizinan == "menunggu") {
        $status = "Menunggu";
      } else {
        $status = "Izin Terbit";
      }

      $data['perizinan'] = $this->Perizinan_model->daftarperizinan($status);
      $data['title'] = 'Daftar Perizinan '.$status;
      $data['breadcrumb'] = '<li> <a href = "'. base_url('operator/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li><li> <a href = "'. base_url('operator/perizinan') .'">Perizinan</a></li><li class="active">Daftar Perizinan</li>';

      $this->template->load('layout/static', 'operator/daftarperizinan', $data);

    }

    public function insertPerizinan($id_izin) {
        $this->load->model('Izin_model');
        $this->load->model('Pemohonizin_model');
        $data['izin'] = $this->Izin_model->getDetailIzin($id_izin);
        $data['nama_izin'] = $this->Izin_model->getAllIzin();
        $data['pemohonizin'] = $this->Pemohonizin_model->getAllPemohonIzin();

        if ($id_izin == "pilih_izin") {
            $data['title'] = 'Jenis Izin';
            $data['breadcrumb'] = '<li> <a href = "'. base_url('operator/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li><li> <a href = "'. base_url('operator/perizinan') .'">Perizinan</a></li><li class="active">Pilih Perizinan</li>';

            $this->template->load('layout/static', 'operator/pilihizin', $data);
        } else {
            if (!isset($_POST['submit'])) {
                //Masuk Ke Form Pengisian Data Perizinan
                $data['title'] = 'Tambah Perizinan';
                $data['breadcrumb'] = '<li> <a href = "'. base_url('operator/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li><li> <a href = "'. base_url('operator/perizinan') .'">Perizinan</a></li><li class="active">Insert Perizinan</li>';

                $this->template->load('layout/static', 'operator/insertperizinan', $data);
            } else {

                if (!empty($_FILES['izin-terbit']['name'])) {
                    $configizin['upload_path']        = './assets/upload/berkasizin/';
                    $configizin['allowed_types']    = 'pdf';
                    $configizin['max_size']        = '5000'; // 5 MB

                    $this->load->library('upload', $configizin);
                    $this->upload->initialize($configizin);

                    if (! $this->upload->do_upload('izin-terbit')) {
                        $error = array('error' => $this->upload->display_errors());
                        $data['error']        = $this->upload->display_errors();
                        $data['title']        = 'Tambah Izin';
                        $data['breadcrumb'] = '<li> <a href = "'. base_url('operator/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li><li> <a href = "'. base_url('operator/perizinan') .'">Perizinan</a></li><li class="active">Insert Perizinan</li>';

                        $this->template->load('layout/static', 'operator/insertperizinan', $data);
                    } else {
                        $upload_izin    = array('upload' => $this->upload->data());

                        //PROSES UPLOAD BERKAS FILE UNTUK PEMOHON IZIN
                        $configberkas['upload_path']    = './assets/upload/berkas';
                        $configberkas['allowed_types']    = 'zip|rar|7z';
                        $configberkas['max_size']        = '13000';

                        $this->load->library('upload', $configberkas);
                        $this->upload->initialize($configberkas);
                        if (! $this->upload->do_upload('berkas')) {
                            unlink('./assets/upload/berkasizin/'.$upload_izin['upload']['file_name']);
                            $data['error']        = $this->upload->display_errors();
                            $data['title']        = 'Tambah Izin';
                            $data['breadcrumb'] = '<li> <a href = "'. base_url('operator/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li><li> <a href = "'. base_url('operator/perizinan') .'">Perizinan</a></li><li class="active">Insert Perizinan</li>';

                            $this->template->load('layout/static', 'operator/insertperizinan', $data);
                        } else {
                            $upload_data      = array('uploads' => $this->upload->data());

                            $date             = date("Y-m-d", strtotime($this->input->post('tgl_izin_dibuat')));
                            $id_perizinan     = $this->db->select("fnCreateIdIzin('$date') as fnCreateIdIzin")->get()->row()->fnCreateIdIzin;
                            $data1            = array('id_perizinan'      => $id_perizinan,
                                                      'nomor_perizinan'   => $this->input->post('nomor_perizinan'),
                                                      'nik_pemohon_izin'  => $this->input->post('nik_pemohon_izin'),
                                                      'nip'               => $this->session->userdata('nip'),
                                                      'id_izin'           => $id_izin,
                                                      'status_perizinan'  => $this->input->post('status_perizinan'),
                                                      'alamat_perizinan'  => $this->input->post('alamat_perizinan'),
                                                      'tgl_perizinan'     => $date,
                                                      'berkas_permohonan' => $upload_data['uploads']['file_name'],
                                                      'berkas_perizinan'  => $upload_izin['upload']['file_name'],
                                                      'jenis_perizinan'   => $this->input->post('jenis_perizinan'));

                            $this->Perizinan_model->insertperizinan($data1);

                            foreach ($data['izin'] as $izin) {
                                $namapost    = str_replace(' ', '_', $izin->nama_syarat);

                                $data2        = array('id_perizinan'        => $id_perizinan,
                                                      'id_syarat'           => $izin->id_syarat,
                                                      'kelengkapan_syarat'  => $this->input->post($namapost));

                                $this->Perizinan_model->insertdetailperizinan($data2);
                            }

                            $this->session->set_flashdata('sukses', 'Izin Berhasil di Input!');
                            redirect(base_url('operator/perizinan'));
                        }
                    }
                    // Jika Upload File Izin Belum Ada Atau Izin Belum Terbit
                } else {

                    $config['upload_path']      = './assets/upload/berkas';
                    $config['allowed_types']    = 'zip|rar|7z';
                    $config['max_size']         = '13000';

                    $this->load->library('upload', $config);

                    if (! $this->upload->do_upload('berkas')) {
                        $data['error']        = $this->upload->display_errors();
                        $data['title']        = 'Tambah Izin';
                        $data['breadcrumb'] = '<li> <a href = "'. base_url('operator/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li><li> <a href = "'. base_url('operator/perizinan') .'">Perizinan</a></li><li class="active">Insert Perizinan</li>';

                        $this->template->load('layout/static', 'operator/insertperizinan', $data);
                    } else {
                        $upload_data    = array('uploads' => $this->upload->data());

                        $date            = date("Y-m-d", strtotime($this->input->post('tgl_izin_dibuat')));
                        $id_perizinan        = $this->db->select("fnCreateIdIzin('$date') AS fnCreateIdIzin")->get()->row()->fnCreateIdIzin;

                        $data1            = array('id_perizinan'        => $id_perizinan,
                                                  'nomor_perizinan'     => $this->input->post('nomor_perizinan'),
                                                  'nik_pemohon_izin'    => $this->input->post('nik_pemohon_izin'),
                                                  'nip'                 => $this->session->userdata('nip'),
                                                  'id_izin'             => $id_izin,
                                                  'status_perizinan'    => $this->input->post('status_perizinan'),
                                                  'alamat_perizinan'    => $this->input->post('alamat_perizinan'),
                                                  'tgl_perizinan'       => $date,
                                                  'berkas_permohonan'   => $upload_data['uploads']['file_name'],
                                                  'jenis_perizinan'     => $this->input->post('jenis_perizinan'));

                        $this->Perizinan_model->insertperizinan($data1);

                        foreach ($data['izin'] as $izin) {
                            $namapost    = str_replace(' ', '_', $izin->nama_syarat);

                            $data2        = array('id_perizinan'        => $id_perizinan,
                                                  'id_syarat'           => $izin->id_syarat,
                                                  'kelengkapan_syarat'  => $this->input->post($namapost));

                            $this->Perizinan_model->insertdetailperizinan($data2);
                        }

                        $this->session->set_flashdata('sukses', 'Izin Berhasil di Input!');
                        redirect(base_url('operator/perizinan'));
                    }
                }
            }
        }
    }

    public function detailIzin($id_perizinan) {

        $detailizin = $this->Perizinan_model->getDetailPerizinan($id_perizinan);

        echo json_encode($detailizin);
    }

    public function laporanperizinan() {
      $this->load->model('Izin_model');
      $data['title'] = 'Laporan Perizinan';
      $data['breadcrumb'] = $data['breadcrumb'] = '<li> <a href = "'. base_url('operator/dashboard') .'"><i class="fa fa-dashboard"></i> Home</a></li><li> <a href = "'. base_url('operator/perizinan') .'">Perizinan</a></li><li class="active">Laporan Perizinan</li>';
      $data['izin'] = $this->Izin_model->getAllIzin();
      $this->template->load('layout/static', 'operator/laporanperizinan', $data);
    }

    public function getLaporanIzin() {

      $tgl = $this->input->post('rangewaktu');
      // $data = array('id_izin' => $this->input->post('nama_izin'),
      //               'tgl_perizinan between' => date("Y-m-d",strtotime(substr($tgl,0,10))),'' => date("Y-m-d",strtotime(substr($tgl,13,23))));
      $data['id_izin'] = $this->input->post('nama_izin');
      $data['wkt_awal'] = date("Y-m-d",strtotime(substr($tgl,0,10)));
      $data['wkt_akhir'] = date("Y-m-d",strtotime(substr($tgl,13,23)));
      $data['sp'] = $this->input->post('status_perizinan');
      $result = $this->Perizinan_model->getLaporanPerizinan($data);

      echo json_encode($result);
    }

    public function cetaklaporan() {
      $tgl = $this->input->post('rangewaktu');
      // $data = array('id_izin' => $this->input->post('nama_izin'),
      //               'tgl_perizinan between' => date("Y-m-d",strtotime(substr($tgl,0,10))),'' => date("Y-m-d",strtotime(substr($tgl,13,23))));
      $data['id_izin'] = $this->input->post('nama_izin');
      $data['wkt_awal'] = date("Y-m-d",strtotime(substr($tgl,0,10)));
      $data['wkt_akhir'] = date("Y-m-d",strtotime(substr($tgl,13,23)));
      $data['sp'] = $this->input->post('status_perizinan');
      $result = $this->Perizinan_model->getLaporanPerizinan($data);

      $pdf = new PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

      $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
      $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
      $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
      $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

      $pdf->SetTitle('Laporan Perizinan Periode '.$tgl);

      if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
          require_once(dirname(__FILE__).'/lang/eng.php');
          $pdf->setLanguageArray($l);
      }

      $pdf->SetPrintHeader(false);
      $pdf->SetPrintFooter(false);
      $pdf->AddPage('L', 'A4');
      $pdf->Image(base_url().'assets/img/logo-belitung.jpg', 35, 5, 18, 20, 'jpg', '', '', true, 150, '', false, false, 0, false, false, false);
      $pdf->SetFont('Calibri', '', 14);
      $pdf->Write(0, 'PEMERINTAH KABUPATEN BELITUNG', '', 0, 'C', true, 0, false, false, 0);
      $pdf->SetFont('Calibri', 'B', 16);
      $pdf->Write(0, 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu', '', 0, 'C', true, 0, false, false, 0);
      $pdf->SetFont('Calibri', '', 11);
      $pdf->Write(0, 'JL. YOS SUDARSO NO.18 TELP.(0719) 24607', '', 0, 'C', true, 0, false, false, 0);
      $pdf->Write(0, 'T A N J U N G P A N D A N', '', 0, 'C', true, 0, false, false, 0);
      $garisheader = '<hr style="height:3px; color:#000; background-color:#000;margin-bottom: 100px; border:none;">';
      $pdf->writeHTML($garisheader, true, false, false, false, '');

      $pdf->SetFont('Calibri','',12);
      $htm = '<table cellspacing="0" cellpadding="1" border="1">
                <tr align="center">
                <th width="15%">No Pendaftaran</th>
                <th>No Izin</th>
                <th>NIK Pemohon Izin</th>
                <th width="10%">Status Perizinan</th>
                <th width="25%">Jenis Perizinan</th>
                <th>Penerima Berkas</th>
                </tr>';

      foreach ($result as $result) {
        $htm .= '<tr>
                  <td align="center">'.$result->id_perizinan.'</td>
                  <td align="center">'.$result->nomor_perizinan.'</td>
                  <td align="center">'.$result->nik_pemohon_izin.'</td>
                  <td align="center">'.$result->status_perizinan.'</td>
                  <td>'.$result->nama_izin.'</td>
                  <td align="center">'.$result->nama_pegawai.'</td>
                </tr>';
      }

      $htm .= '</table>';
      $pdf->writeHTML($htm, true, false, false, false, '');


      $pdf->Output('Laporan Perizinan.pdf', 'I');
    }

    public function editNomorPerizinan($id_perizinan) {

        $this->form_validation->set_rules('nomor_perizinan','No Id Izin','trim|required|is_unique[tbl_perizinan.id_perizinan]',
                                array('required'   => 'Nomor Izin Tidak Boleh di Kosongkan',
                                      'is_unique'  => 'Nomor Izin Sudah ada'));

        if ($this->form_validation->run()) {
            $data = array('id_perizinan'        => $id_perizinan,
                              'nomor_perizinan'    => $this->input->post('nomor_perizinan'));

            $msg['success'] = false;

            $result = $this->Perizinan_model->updatePerizinan($id_perizinan, $data);

            if ($result) {
                $msg['success'] = true;
            }

            echo json_encode($msg);
        } else {
            $msg['errors'] = validation_errors();
            echo json_encode($msg);
        }
    }

    public function editStatusPerizinan($id_perizinan) {
        $data = array('id_perizinan'        => $id_perizinan,
                      'nip'                 => $this->session->userdata('nip'),
                      'status_perizinan'    => $this->input->post('status_perizinan'));

        $msg['success'] = false;

        $result = $this->Perizinan_model->updatePerizinan($id_perizinan, $data);

        if ($result) {
            $msg['success'] = true;
        }

        echo json_encode($msg);
    }

    public function cetakTandaTerima($id_perizinan, $nik_pemohon_izin) {

        $this->load->model('Pemohonizin_model');

        $izin = $this->Perizinan_model->getDetailPerizinan($id_perizinan);
        $user = $this->Pemohonizin_model->getDetailPemohonIzin($nik_pemohon_izin);

        $pdf = new PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        $pdf->SetTitle($nik_pemohon_izin .' - '. $izin[0]->nama_izin);

        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->AddPage();
        $pdf->Image(base_url().'assets/img/logo-belitung.jpg', 15, 5, 18, 20, 'jpg', '', '', true, 150, '', false, false, 0, false, false, false);
        $pdf->SetFont('Calibri', '', 11);
        $pdf->Write(0, 'PEMERINTAH KABUPATEN BELITUNG', '', 0, 'C', true, 0, false, false, 0);
        $pdf->SetFont('Calibri', 'B', 14);
        $pdf->Write(0, 'BADAN PENANAMAN MODAL DAN PELAYANAN PERIZINAN TERPADU', '', 0, 'C', true, 0, false, false, 0);
        $pdf->SetFont('Calibri', '', 11);
        $pdf->Write(0, 'JL. YOS SUDARSO NO.18 TELP.(0719) 24607', '', 0, 'C', true, 0, false, false, 0);
        $pdf->Write(0, 'T A N J U N G P A N D A N', '', 0, 'C', true, 0, false, false, 0);
        $garisheader = '<hr style="height:3px; color:#000; background-color:#000;margin-bottom: 100px; border:none;">';
        $pdf->writeHTML($garisheader, true, false, false, false, '');
        $pdf->setFont('Calibri', 'BU', '16');
        $pdf->Write(0, 'TANDA TERIMA PERMOHONAN '.$izin[0]->nama_izin.'', '', 0, 'C', true, 0, false, false, 0);

        $pdf->setFont('Calibri', '', '10');
        $tbl_head = '<table>
						<tr>
							<td style="width: 4cm;">Telah diterima Dari</td>
							<td style="width: 76.5%;">: ...........................................................................................................................................................</td>
						</tr>
						<tr>
							<td style="width: 4cm;">No. Telp/HP</td>
							<td style="width: 76.5%;">: '.$user->tlp_pemohon_izin.'</td>
						</tr>
						<tr>
							<td style="width: 4cm;">Banyaknya</td>
							<td style="width: 76.5%;">: 1(satu berkas)</td>
						</tr>
						<tr>
							<td style="width: 4cm;" rowspan="2">Berupa</td>
							<td style="width: 76.5%;">: berkas permohonan '.$izin[0]->nama_izin.' an '.$user->nama_pemohon_izin.'</td>
						</tr>
						<tr>
							<td style="width: 76.5%;">  '.$izin[0]->alamat_perizinan.'</td>
						</tr>

						<tr>
							<td style="width: 4cm;">Alamat Pemohon</td>
							<td style="width: 76.5%;">: '.$user->alamat_pemohon_izin.'</td>
						</tr>
            <tr>
            <td>
            </td>
            </tr>
						<tr>
							<td style="width: 100%;">Dengan syarat sebagai berikut: </td>
						</tr>
					</table>';
        $pdf->writeHTML($tbl_head, false, false, false, false, '');
        $tbl_body = '<table cellpadding="1">';
        $no = 1;
        $len = count($izin)+1;
        $tbl_body .= '<tr><td rowspan="'.$len.'" style="width: 10px;"></td></tr>';
        foreach ($izin as $izin) {
            $tbl_body .= '<tr>
							<td style="width:20px;">'.$no.'.</td>
							<td style="width:80%">'.$izin->nama_syarat.'</td>';

            if ($izin->kelengkapan_syarat == "Lengkap") {
                $tbl_body .= '<td>: Ada/<strike>Tidak Ada</strike></td>';
            } else {
                $tbl_body .= '<td>: <strike>Ada</strike>/Tidak Ada</td>';
            }

            $tbl_body .= '</tr>';
            $no++;
        }
        $tbl_body .= '</table>';
        $pdf->writeHTML($tbl_body, true, false, false, false, '');

        $tbl_footer = '<table>
							<tr>
								<td style="width:65%">Berkas Permohonan Tersebut</td>
								<td style="width:40%">: Lengkap/<strike>Tidak Lengkap</strike>/<strike>Belum Lengkap</strike></td>
							</tr>
						</table>';
        $pdf->writeHTML($tbl_footer, true, false, false, false, '');
        $tbl_ttd = '<table>
						<tr>
							<td align="center">Yang Menerima</td>
							<td></td>
							<td align="center">Yang Menyerahkan</td>
						</tr>
						<tr>
							<td style="height:70px"></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td align="center">_______________________</td>
							<td></td>
							<td align="center">_______________________</td>
						</tr>
					</table>';
        $pdf->writeHTML($tbl_ttd, true, false, false, false, '');
        $pdf->setY(-15);
        $pdf->Write(0, ''.base_url('portal/izin/cek_izin/'.$izin->id_perizinan).'', '', 0, 'R', true, 0, false, false, 10);

        $pdf->Output(''.$nik_pemohon_izin.'.pdf', 'I');
    }
}

<?php

namespace App\Controllers;

use App\Models\KeysModel;

class Connect extends BaseController
{
    protected $model, $game, $uKey, $sDev;

    public function __construct()
    {
        include('conn.php');
        
        $sql1 ="select * from onoff where id=11";
        $result1 = mysqli_query($conn, $sql1);
        $userDetails1 = mysqli_fetch_assoc($result1);
        
        $this->model = new KeysModel();
        $this->maintenance = false;
        $this->staticRandw = "Vm8Lk7Uj2JmsjCPVPVjrLa7zgfx3uz9E";
        
        if($userDetails1['status'] == 'on'){
        
        $this->maintenance = false;
        
        }
        if($userDetails1['status'] == 'off'){
        
        $this->maintenance = true;
        
        }
        
        
        $this->staticWords = "KHJGGUDFKDFGYFGVnfdCDFcj2JvmvvHvsj7zgJDfvvHx3uz9E";
    }

    public function index()
    {
        if ($this->request->getPost()) {
            return $this->index_post();
        } else {
            $nata = [
                "web_info" => [
                    "_client" => BASE_NAME,
                    "license" => "Qp5KSGTquetnUkjX6UVBAURH8hTkZuLM",
                    "version" => "1.0.0",
                ],
                "web__dev" => [
                    "Author" => "@MR_PRINCE_KHAN",
                    "Telegram" => "https://telegram.me/Hacks_Only_Hacks"
                ],
            ];

            /*         return "
<body>
<style>

.wrapper {
    height: 800px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #000000; 
}
.txt {
    color: #ffffff;
    background:#000000;
    font-size:200px;
    font-weight: bold;
    font-family: Arial;
    text-transform: uppercase;
}
.neon wrapper {
    display: inline-flex;
}
.txt::before {
    content: 'hey';
    position: absolute;
    mix-blend-mode: difference;
}
.txt::before {
    content: 'hey';
    position: absolute;
    mix-blend-mode: difference;
    filter: blur(3px);
}
.neon-wrapper {
    display:inline-flex;
    filter: brightness(200%);
}
.gradient{
    background: linear-gradient(114.5793141156962deg, rgba(6, 227, 250,1) 4.927083333333334%,rgba(229, 151, 64,1) 97.84374999999999%);
    position: absolute;
    top: 0;
    left:0;
    width: 100%;
    height:100%;
    mix-blend-mode: multiply;
}  
.dodge {
    background: radial-gradient(circle,white,black 35%) center / 25% 25%;
    position: absolute;
    top:-100%;
    left:-100%;
    right:0;
    bottom:0;  
    mix-blend-mode: color-dodge;
    animation: dodge-area 3s linear infinite;
}
@keyframes dodge-area {
    to {
        transform: translate(50%,50%);
    }

}
.neon-wrapper {
    display:inline-flex;
    filter: brightness(200%);
    overflow: hidden;
}

</style>




    <div class='navbar'><span>neon text effect</div><pan>
<div class='wrapper'>
    
    <div class='neon-wrapper'>
        <span class='txt'>hey</span>
        <span class='gradient'></span>
        <span class='dodge'></span>
    </div>
   </div>
</body>";*/

            return "<h1><strong><center><font size='10' color='red' face='arial'><marquee direction='right' scrollamount='15'>ANDI MANDI SANDI TUMNE<br> ESKO KHOLA TO TUM RANDI !</marquee></font></center></strong></h1>"; //$this->response->setJSON($nata);
        }
    }

    public function index_post()
    {
        $isMT = $this->maintenance;
        $game = $this->request->getPost('game');
        $uKey = $this->request->getPost('user_key');
        $sDev = $this->request->getPost('serial');

        if ($isMT) {
            
            include('conn.php');
        
            $sql1 ="select * from onoff where id=11";
            $result1 = mysqli_query($conn, $sql1);
            $userDetails1 = mysqli_fetch_assoc($result1);
        
            
            $data = [
                'status' => false,
                'reason' => $userDetails1['myinput']
            ];
        } else {
            if (!$game or !$uKey or !$sDev) {
                $data = [
                    'status' => false,
                    'reason' => 'INVALID PARAMETER'
                ];
            } else {
                $time = new \CodeIgniter\I18n\Time;
                $model = $this->model;
                $findKey = $model
                    ->getKeysGame(['user_key' => $uKey, 'game' => $game]);

                if ($findKey) {
                    if ($findKey->status != 1) {
                        $data = [
                            'status' => false,
                            'reason' => 'USER BLOCKED'
                        ];
                    } else {
                        $id_keys = $findKey->id_keys;
                        $duration = $findKey->duration;
                        $expired = $findKey->expired_date;
                        $max_dev = $findKey->max_devices;
                        $devices = $findKey->devices;

                    function checkDevicesAdd($serial, $devices, $max_dev)
                    {
                        $lsDevice = explode(",", $devices);
                        $cDevices = count($lsDevice);
                        $serialOn = in_array($serial, $lsDevice);

                        if ($serialOn) {
                            return true;
                        } else {
                            if ($cDevices < $max_dev) {
                                array_push($lsDevice, $serial);
                                $setDevice = reduce_multiples(implode(",", $lsDevice), ",", true);
                                return ['devices' => $setDevice];
                            } else {
                                // ! false - devices max
                                return false;
                            }
                        }
                    }

                    if (!$expired) {
                        $setExpired = $time::now()->addDays($duration);
                        $model->update($id_keys, ['expired_date' => $setExpired]);
                        $data['status'] = true;
                    } else {
                        if ($time::now()->isBefore($expired)) {
                            $data['status'] = true;
                        } else {
                            $data = [
                                'status' => false,
                                'reason' => 'EXPIRED KEY contact @MR_PRINCE_KHAN'
                            ];
                        }
                    }


                    if ($data['status']) {
                        $devicesAdd = checkDevicesAdd($sDev, $devices, $max_dev);
                        include('conn.php');
        
                            $sql2 ="select * from modname where id=1";
                            $result2 = mysqli_query($conn, $sql2);
                            $userDetails2 = mysqli_fetch_assoc($result2);
                            
                            $sql3 ="select * from _ftext where id=1";
                            $result3 = mysqli_query($conn, $sql3);
                            $userDetails3 = mysqli_fetch_assoc($result3);
                            
                        if ($devicesAdd) {
                            if (is_array($devicesAdd)) {
                                $model->update($id_keys, $devicesAdd);
                            }
                            $real = "$game-$uKey-$sDev-$this->staticRandw";
                            
                             $expiry = $findKey->expired_date;
                            if ($expiry == null) {
                                 $expiry = $time::now()->addDays($duration);
                            }
                            
                            $data = [
                                'status' => true,
                                'data' => [
                                    'modname' => $userDetails2['modname'],
                                     'mod_status' => $userDetails3['_status'],
                                    'credit' => $userDetails3['_ftext'],
                                     'device'=> $max_dev,
                                     'balimods' => $expired,
                                     'real' => $real,
                                    'token' => md5($real),
                                     'exdate' => $expiry,
                                    'rng' => $time->getTimestamp()
                                ],
                            ];
                            
                        } else {
                            $data = [
                                'status' => false,
                                'reason' => 'MAX DEVICE REACHED DM @MR_PRINCE_KHAN'
                            ];
                        }
                    }
                    }
                } else {
                    $data = [
                        'status' => false,
                        'reason' => 'USER OR GAME NOT REGISTERED'
                    ];
                }
            }
        }
        return $this->response->setJSON($data);
    }
}

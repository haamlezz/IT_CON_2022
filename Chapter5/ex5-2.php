<?php
//multi-dimension array

$animals = array(
    "cat" => array("name"=>"ລຸລີ່", "legs"=>4, "seed"=>"ປາ"),
    "duck" => array("name"=>"ແພັດດີ້", "legs"=>2, "seed"=>"ຫອຍ"),
    "dog" => array("name"=>"ຊູໂມ", "legs"=>4, "seed"=>"ເຂົ້າ")
);

echo $animals["dog"]["name"];
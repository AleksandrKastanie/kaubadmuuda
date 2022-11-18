<?php
$yhendus=new mysqli("localhost", "tarp21", "roof10023!", "tarp21");
$yhendus->set_charset('utf8');
/*
create table kaubagrupid(
    id int primary key auto_increment,
    grupinimi varchar(50)
)

create table  kaubad (
    id int primary key auto_increment,
    nimetus varchar(30),
    kaubagrupi_id int,
    hind int,
    foreign key (kaubagrupi_id) references kaubagrupid (id)
)
*/
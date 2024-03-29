<?php
class Createdb extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('Createdbmodel');
	}
	private $ar=array();

	function newTable(){
		$this->initArray();
		foreach ($this->ar as $a) {
			$this->Createdbmodel->createTable($a);
		}
		
	}

	function initArray(){
		$c1="create table Categories(
		id int not null auto_increment primary key,
		category varchar(64),
		color1 double,
		color2 double,
		color3 double
		)default charset=utf8";
		$c2="create table Roles(
		id int not null auto_increment primary key,
		role varchar(32)
		)default charset=utf8";
		$c3="create table Users(
		id int not null auto_increment primary key,
		login varchar(64), 
		pass varchar(256),
		email varchar(64),
		stamp int,
		posts int,
		roleid int not null,
		foreign key (roleid) references Roles(id) on delete cascade
		)default charset=utf8";
		$c4="create table Statuses(
		id int not null auto_increment primary key,
		status varchar(32)
		)default charset=utf8";
		$c5="create table Places(
		id int not null auto_increment primary key,
		title varchar(128),
		catid int,
		foreign key (catid) references Categories(id) on delete cascade,
		lat double,
		lng double,
		info varchar(1024),
		ulike int,
		udislike int,
		statusid int,
		foreign key (statusid) references Statuses(id) on delete cascade,
		userid int not null,
		foreign key (userid) references Users(id) on delete cascade,
		stamp int,
		link varchar(256)
		)default charset=utf8";
		$c6="create table Images(
		id int not null auto_increment primary key,
		imagepath varchar(32),
		placeid int,
		foreign key (placeid) references Places(id) on delete cascade
		)default charset=utf8";
		$c7="create table Themes(
		id int not null auto_increment primary key,
		title varchar(128) not null,
		catid int,
		foreign key (catid) references Categories(id) on delete cascade,
		placeid int,
		userid int not null,
		foreign key (userid) references Users(id) on delete cascade,
		statusid int,
		foreign key (statusid) references Statuses(id) on delete cascade,
		stamp int,
		content varchar(2048)
		)default charset=utf8";
		$c8="create table Posts(
		id int not null auto_increment primary key,
		userid int not null,
		foreign key (userid) references Users(id) on delete cascade,
		statusid int not null,
		foreign key (statusid) references Statuses(id) on delete cascade,
		themeid int not null,
		foreign key (themeid) references Themes(id) on delete cascade,
		stamp int not null,
		content varchar(2048)
		)default charset=utf8";
		$c9="create table Messages(
		id int not null auto_increment primary key,
				userid int not null,
		foreign key (userid) references Users(id) on delete cascade,
		comment varchar(2048),
		stamp int
		)default charset=utf8";
		$this->ar=array($c1,$c2,$c3,$c4,$c5,$c6,$c7,$c8,$c9);
	}
}
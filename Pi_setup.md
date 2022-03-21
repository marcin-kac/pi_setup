Pi setup

1.download Raspberry Pi Imager
	https://www.raspberrypi.com/software/

2.download Raspberry Pi OS Lite
	https://www.raspberrypi.com/software/operating-systems/#raspberry-pi-os-32-bit

3.create Raspberry pi image, use advanced option to create user/password , enable ssh and connect to local wifi - best is to create hotspot on your phone 

4.connect your laptop to the same wi-fi as you set for Pi

once image is created insert SD card to Pi and power it up.After few minutes you should be able to find IP address of your pi on the network - use nmap -p 22 x.x.x.x

ssh to your pi from your laptop

  run the fallowing 

	sudo apt-get update
	sudo apt-get upgrade
	sudo apt-get install isc-dhcp-server lighttpd xinetd tftpd tft vim ntp  -y

	sudo vi  /etc/xinetd.d/tftp

	service tftp
	{
	protocol        = udp
	port            = 69
	socket_type     = dgram
	wait            = yes
	user            = nobody
	server          = /usr/sbin/in.tftpd
	server_args     = /var/www/html/
	disable         = no
	}

	sudo chown -R www-data:www-data /var/www
	sudo service xinetd restart
	
	sudo vim /etc/ntp.conf
	
	# If you want to provide time to your local subnet, change the next line.
        # (Again, the address is an example only.)
        broadcast 10.3.14.255  < change this from default 
	
	sudo service ntp restart
	
	sudo vi /etc/default/isc-dhcp-server
	change from INTERFACESv4="" to INTERFACESv4="eth0"
	

	sudo vi /etc/network/interfaces

	auto eth0
		iface eth0 inet static
		address 10.3.14.1/24

	sudo ifup eth0
 
	sudo cp /etc/dhcp/dhcpd.conf /etc/dhcp/dhcpd.conf.bk
	sudo vi /etc/dhcp/dhcpd.conf

	# This is a very basic subnet declaration.
	subnet 10.3.14.0 netmask 255.255.255.0 {
  	range 10.3.14.100 10.3.14.200;
  	option domain-name "internal.example.org";
  	option broadcast-address 10.3.14.255;
  	default-lease-time 600;
  	max-lease-time 7200;
	}

 	or just copy entire dhcpd.conf file from wiki 

 	sudo service isc-dhcp-server restart
 	


Connect Pi your laptop to switch , at this stage you should be able to connect to Pi using wired network   at 10.3.14.1


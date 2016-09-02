on-set-up {
    upload '/root/www/inq.zip' '../../sys/load/'
    ssh zip un '../../sys/load/inq.zip'
	ssh exec '../../sys/load/install'
}
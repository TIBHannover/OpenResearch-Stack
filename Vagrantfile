# -*- mode: ruby -*-
# vi: set ft=ruby :

## to avoid "The following settings shouldn't exist" "pip_install_cmd"
Vagrant.require_version ">= 2.2.5"

Vagrant.configure("2") do |config|

  ## ===== Required Vagrant Plugins =====
  ## https://michaelheap.com/vagrant-require-installed-plugins/

  plugin_installed = false
 
	[
	  { :name => "vagrant-vbguest", :version => "0.26.0" }
	].each do |plugin|
	  if not Vagrant.has_plugin?(plugin[:name], plugin[:version])
      system "vagrant plugin install #{plugin[:name]} --plugin-version #{plugin[:version]}"
      plugin_installed = true
	  end
	end

  if plugin_installed == true
    exec "vagrant #{ARGV.join(' ')}"
  end
 
 
  ## ===== Base Box =====
  #config.vm.box = "bento/ubuntu-20.04"
  #config.vm.box_version = "202107.07.0"

  ## https://github.com/dotless-de/vagrant-vbguest/issues/414
  #config.vm.box = "debian/buster64"
  #config.vm.box_version = "10.20210409.1"

  config.vm.box = "bento/debian-10"
  config.vm.box_version = "202107.08.0"
  
  ## ===== Network =====
  config.vm.network "forwarded_port", guest: 22, host: 2222, host_ip: "127.0.0.1", id: 'ssh'
  config.vm.network "forwarded_port", guest: 80, host: 8080, auto_correct: true
  config.vm.network "forwarded_port", guest: 443, host: 8443, auto_correct: true
  config.vm.network "private_network", type: "dhcp"


  ## ===== Shared Folder / VBoxGuestAdditions =====
  config.vbguest.installer_arguments = "--nox11"
  #config.vbguest.installer_options = { allow_kernel_upgrade: true }

  # make sure permissions are not world-readable, otherwise Ansible will ignore ansible.cfg
  config.vm.synced_folder "./ansible", "/ansible", mount_options: ["dmode=755,fmode=644"], create: true, type: "virtualbox"

  
  ## ===== VirtualBox Settings =====  
  config.vm.provider "virtualbox" do |vb|
  	vb.name = "vagrant_ansible_openresearch_" + Time.now.strftime("%y%m%d%H%M")
    vb.gui = false
    vb.memory = "2048"
    vb.cpus = 2
	
    ## https://github.com/chef/bento/issues/688
    vb.customize ["modifyvm", :id, "--cableconnected1", "on"]
  end


  ## ===== Housekeeping ====
  config.vm.provision "shell" do |shell|
    ## "Make sure /ansible/roles is empty"
    shell.inline = "rm -Rf /ansible/roles/*"
  end


  ## ===== Install =====
  config.vm.provision "install", type: "ansible_local" do |ansible|
    
    ## attempt to install 2.10.7
    ## 1) with install_mode="pip"
    ##    → ERROR: This script does not work on Python 2.7 The minimum supported Python version is 3.6.
    ## 2) with pip_install_cmd = "sudo apt install -y python3-distutils && curl https://bootstrap.pypa.io/get-pip.py | sudo python3"
    ##    → The requested Ansible version (2.10.7) was not found on the guest. Please check the Ansible installation on your Vagrant guest system (currently: 2.10.11)
    ##    → see also https://github.com/hashicorp/vagrant/issues/12204
    ## 3) with install_mode = "pip_args_only"
    ##     and pip_args = "ansible==2.10.7"
    ##     and version not specified
    ansible.install_mode = "pip_args_only"
    ansible.pip_install_cmd = "sudo apt install -y python3-distutils && curl https://bootstrap.pypa.io/get-pip.py | sudo python3"
    ansible.pip_args = "ansible==2.10.7"
    ansible.extra_vars = { ansible_python_interpreter:"/usr/bin/python3" }
    #ansible.version = "2.10.7"

    ## "latest" will install 2.9.6 from package manager
    ## → lead to https://github.com/robertdebock/ansible-role-bootstrap/issues/47
    #ansible.version = "latest"

    ansible.compatibility_mode = "2.0"
    ansible.provisioning_path = "/ansible"
    ansible.playbook = "playbook.yml"
    ansible.galaxy_role_file = "requirements.yml"
  end
end
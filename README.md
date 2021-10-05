# OpenResearch Stack
Build a local OpenResearch Stack (MediaWiki & Extensions) with Vagrant and Ansible on VirtualBox.

It currently supports Debian and Ubuntu guest operating systems and MediaWiki 1.31+. See also the COMPATIBILITY MATRIX in [playbook.yml](ansible/playbook.yml) for details. 

## Requirements
This project has been tested on Windows with the following versions:
- Vagrant 2.2.14
- VirtualBox 5.2.42
- Git for Windows 2.28.0

It might also work on other operating systems and versions. 

> **Note:** Ansible is installed on the guest operating system and not required on your computer. 


## Getting Started
* Clone this project to a local working directory
* Open Git Bash in your local working directory (right click → Git Bash here)
* Run `vagrant up`. This will
  * download the required guest operating system base box,
  * install required Vagrant plugins if not already installed,
  * run the Ansible provisioner
* Ansible will download the required roles and run the play from playbook.yml
* After a few minutes you should have a local MediaWiki running at http://localhost:8080/openresearch

> **Note:** Opening MediaWiki for the first time might take up to a minute, since the SCSS files needs to be compiled.

### Defaults / Variables
* see `group_vars/all.yml`

### Vagrant Commands

- `vagrant up`                  -- starts vagrant environment (also provisions only on the FIRST vagrant up)
- `vagrant provision`           -- forces reprovisioning of the vagrant machine
- `vagrant reload`              -- restarts vagrant machine, loads new Vagrantfile configuration
- `vagrant reload --provision`  -- restart the virtual machine and force provisioning
- `vagrant halt`                -- stops the vagrant machine
- `vagrant ssh`                 -- connects to machine via SSH
- `vagrant destroy`             -- stops and deletes all traces of the vagrant machine

## Built With
This project is build on top of the Ansible Roles listed in [requirements.yml](ansible/requirements.yml). 

## Versioning
We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/TIBHannover/OpenResearch-Stack/tags). 

## Author(s)
* Alexander Gesinn
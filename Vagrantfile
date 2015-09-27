# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.require_version ">= 1.6.5"
require 'time'

class String
  def red;            "\033[31m#{self}\033[0m" end
  def green;          "\033[32m#{self}\033[0m" end
end

VAGRANTFILE_API_VERSION = "2"

%w(ZP_ZS_ORDER_NUMBER ZP_ZS_LICENSE_KEY ZP_ZS_API_KEY_NAME ZP_ZS_API_KEY_SECRET ZP_DB_PASSWORD ZP_ZS_VERSION ZP_PHP_VERSION ZP_DEV_EMAIL).each do |envvar|
  if ENV[envvar].nil?
    puts envvar + " is not set\n".red
    puts "Let me less the README.md for you :)\n".green
    sleep 3
    system 'less README.md'
    abort("Environment variables are not set, please correct and restart".red)
  end
end

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

  config.omnibus.chef_version = :latest

  config.vm.box = "julienguittard/ubuntu-14.04"
  config.hostmanager.enabled = true
  config.hostmanager.manage_host = true
  config.hostmanager.ignore_private_ip = false
  config.vm.define 'zpress-box' do |node|
    node.vm.hostname = "zpress.local"
    node.vm.network "forwarded_port", guest: 80, host: 8888
    node.vm.network "forwarded_port", guest: 10081, host: 10091
    node.vm.network "forwarded_port", guest: 10082, host: 10092
    node.hostmanager.aliases = %w(www.zpress.local)
  end

  config.berkshelf.enabled = true
  config.berkshelf.berksfile_path = "./Berksfile"
  config.vm.synced_folder ".", "/vagrant", owner: "vagrant", group: "www-data", mount_options: ['dmode=775', 'fmode=775']


  config.vm.provider "vmware_fusion" do |v|
    v.vmx["memsize"] = "2048"
    v.vmx["numvcpus"] = "2"
  end

  config.vm.provision "chef_solo" do |chef|
      chef.json = {
        zendserver: {
          version: "#{ENV['ZP_ZS_VERSION']}",
          phpversion: "#{ENV['ZP_PHP_VERSION']}",
          basedirdeb: "deb_apache2.4",
          adminpassword: "admin",
          production: "false",
          apikeyname: "#{ENV['ZP_ZS_API_KEY_NAME']}",
          apikeysecret: "#{ENV['ZP_ZS_API_KEY_SECRET']}", # Needs to be 64 alnum characters
          ordernumber: "#{ENV['ZP_ZS_ORDER_NUMBER']}",
          licensekey: "#{ENV['ZP_ZS_LICENSE_KEY']}",
          adminemail: "#{ENV['ZP_DEV_EMAIL']}",
          directives: {
            error_reporting: "E_ALL",
            display_errors: "1",
            display_startup_errors: "1"
          }
        },
        apache: {
            mpm: "prefork"
        },
        mysql: {
            server_root_password: "#{ENV['ZP_DB_PASSWORD']}"
        },
        vhost: {
            hostname: "zpress.local",
            fqdn: "www.zpress.local"
        }
      }

      chef.run_list = [
        "recipe[tools::apt-update]",
        "recipe[build-essential]",
        "recipe[conf]",
        "recipe[zendserver::single]",
        "recipe[vhost]",
        "recipe[git]",
        "recipe[mysql::server]",
        "recipe[tools::phing]",
        "recipe[tools::composer]"
      ]
  end
end

ENV['VAGRANT_DEFAULT_PROVIDER'] = 'vmware_fusion'
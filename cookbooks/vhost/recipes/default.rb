include_recipe "apache2"

web_app "vagrant_vhost" do
  server_port 80
  directory_options ["FollowSymLinks","MultiViews"]
  allow_override "FileInfo"
  server_name node['hostname']
  server_aliases [node['fqdn']]
  docroot "/vagrant"
end
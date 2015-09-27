execute "Updating system packages" do
  command "apt-get update"
  action :run
end
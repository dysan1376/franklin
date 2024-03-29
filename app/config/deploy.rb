set :application, "franklin"
set :user,        "root"
set :domain,      "#{user}@45.55.30.28"
set :deploy_to,   "/var/www/html/#{application}"
set :app_path,    "app"

#set :repository,  "file:///Applications/MAMP/htdocs/hospi"
set :repository,  "https://github.com/dysan1376/franklin.git"
set :scm,         :git
#set :deploy_via,  :copy
# Or: `accurev`, `bzr`, `cvs`, `darcs`, `subversion`, `mercurial`, `perforce`, or `none`

set :model_manager, "doctrine"
# Or: `propel`

role :web,        domain                         # Your HTTP server, Apache/etc
role :app,        domain, :primary => true       # This may be the same as your `Web` server


set  :shared_files,      ["app/config/parameters.yml"]
set  :shared_childres,   [app_path + "/logs", web_path + "/uploads", "vendor"]


#set  :use_composer,    true
set  :composer_options, '--no-interaction --quiet --optimize-autoloader --no-progress'
#Workaround reciente para evitar que se quede estancado en install composer dependencies
#También es necesario comentar #set use_composer, true
#set  :update_vendors,  true
set  :copy_vendors,   true
#set :dump_assetic_assets, true

set  :keep_releases,  3

after "deploy:update", "deploy:mkdirs", "deploy:cleanup"

namespace :deploy  do
	desc "Permisos para escritura en app/cache"
	task :chmodcache do 
		run(" sudo chmod -R 777 #{current_path}/app/cache")
	end
end

namespace :deploy do
	desc "Crear app/cache, app/logs"
	task :mkdirs do
		run(" sudo chmod -R 777 #{release_path}/app/cache #{release_path}/app/logs")
	end
end


# Be more verbose by uncommenting the following line
#logger.level = Logger::MAX_LEVEL
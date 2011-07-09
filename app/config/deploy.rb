set :application, "Navigator"
set :deploy_to,   "/root/navigator"
set :app_path,    "app"

set :repository,  "git://github.com/dcestari/navigator.git"
set :scm,         :git
set :git_enable_submodules, 1
set :git_enable_externals, 1
# Or: `accurev`, `bzr`, `cvs`, `darcs`, `subversion`, `mercurial`, `perforce`, `subversion` or `none`

server "64.37.54.237", :web, :app, :db

set  :keep_releases,  3
set :use_sudo, false
set :user, "root"

before "deploy:finalize_update", "symfony:setup_vendors"

namespace :symfony do
  task :setup_vendors do
    run "cd #{release_path} && cd vendor/symfony && ./vendors.php"
  end
end


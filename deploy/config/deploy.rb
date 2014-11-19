namespace :deploy do
  desc 'Deploy to AWS server'
  after :updated, :build do
      on roles(:aws) do
        execute "cd #{release_path} && curl -sS https://getcomposer.org/installer | php"
        execute "cd #{release_path} && php composer.phar install --no-dev -q"
        count = fetch(:keep_releases, 5).to_i
        execute "ls -1dt #{releases_path}/* | tail -n +#{count + 1} | xargs sudo rm -rf"
      end
  end
end

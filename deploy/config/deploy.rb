lock '3.1.0'

namespace :deploy do
  desc 'Deploy to AWS server'
  after :updated, :build do
      within release_path do
        execute "cd #{release_path} && composer install --no-dev -q"
        count = fetch(:keep_releases, 5).to_i
        execute :ls, "-1dt #{releases_path}/* | tail -n +#{count + 1} | xargs sudo rm -rf"
      end
  end
end

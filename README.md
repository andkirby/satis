# Satis

Simple static Composer repository generator.

[![Build Status](https://travis-ci.org/composer/satis.svg?branch=master)](https://travis-ci.org/composer/satis)

Satis - Package Repository Generator
====================================
(Kirby's Edition for multi-package repository)
# Multi-package repository
To use multi-package repository please use type "vcs-namespace".
```
{
  "repositories": [
    {
      "type": "vcs-namespace",
      "url": "git@github.com:yourname/yourrepo"
    }
  ]
}
```
It works with andkirby/multi-repo-composer. You may read more about [multi-repository requirements](https://github.com/andkirby/multi-repo-composer).
=====================================


## Run from source

- Install satis: `composer create-project composer/satis:dev-master --keep-vcs`
- Build a repository: `php bin/satis build <configuration-file> <output-dir>`

Read the more detailed instructions in the [documentation][].


## Run as Docker container

Pull the image:

``` sh
docker pull composer/satis
```

Run the image:

``` sh
docker run --rm -it -v /build:/build composer/satis
```

 > Note: by default it will look for a configuration file named `satis.json`
    inside the `/build` directory and dump the generated output files in
    `/build/output`.

Run the image (with Composer cache from host):

``` sh
docker run --rm -it -v /build:/build -v $COMPOSER_HOME:/composer composer/satis
```

If you want to run the image without implicitly running Satis, you have to
override the entrypoint specified in the `Dockerfile`:

``` sh
docker run --rm -it --entrypoint /bin/sh composer/satis
```


## Purge

If you choose to archive packages as part of your build, over time you can be
left with useless files. With the `purge` command, you can delete these files.

``` sh
php bin/satis purge <configuration-file> <output-dir>
```

 > Note: don't do this unless you are certain your projects no longer reference
    any of these archives in their `composer.lock` files.


## Updating

Updating Satis is as simple as running `git pull && composer update` in the
Satis directory.

If you are running Satis as a Docker container, simply pull the latest image.


## Contributing

Please note that this project is released with a [Contributor Code of Conduct][].
By participating in this project you agree to abide by its terms.

Fork the project, create a feature branch, and send us a pull request.


## Authors

See the list of [contributors][] who participate(d) in this project.


## Community Tools

- [satis-go][] - A simple web server for managing Satis configuration and
    hosting the generated Composer repository.
- [satisfy][] - Symfony based composer repository manager with a simple web UI.
- [satis-control-panel][] - Simple web UI for managing your Satis Repository
    with optional CI integration.
- [composer-satis-builder][] - Simple tool for updating the Satis configuration
    (satis.json) "require" key on the basis of the project composer.json.


## License

Satis is licensed under the MIT License - see the [LICENSE][] file for details


[documentation]: https://getcomposer.org/doc/articles/handling-private-packages-with-satis.md
[Contributor Code of Conduct]: http://contributor-covenant.org/version/1/4/
[contributors]: https://github.com/composer/satis/contributors
[satis-go]: https://github.com/benschw/satis-go
[satisfy]: https://github.com/ludofleury/satisfy
[satis-control-panel]: https://github.com/realshadow/satis-control-panel
[composer-satis-builder]: https://github.com/AOEpeople/composer-satis-builder
[LICENSE]: https://github.com/composer/satis/blob/master/LICENSE

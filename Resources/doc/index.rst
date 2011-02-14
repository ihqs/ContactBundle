Provides a simple but powerful contact form built onto the Observer Pattern.
Plug any listener you want to your contact form's submission

Features
========

- Compatible with Doctrine ORM **and** ODM thanks to a generic repository.
- Model is extensible at will
- Observer Pattern designed for more flexibility
- Every class is customizable

Installation
============

Add ContactBundle to your src/ dir
----------------------------------

::

    $ git submodule add git://github.com/ihqs/ContactBundle.git    src/IHQS/ContactBundle

If you want to connect the email listener, install SwitfMailer and configure it

::
    $ git submodule add git://github.com/swiftmailer.git    src/vendor/swiftmailer

In your config, add :

::
    swiftmailer.config:
        transport:  smtp
        encryption: ssl
        auth_mode:  login
        host:       domain.tld
        username:   name@domain.tld
        password:   your_secret



Add the IHQS namespace to your autoloader
-----------------------------------------

::
    // app/autoload.php
    $loader->registerNamespaces(array(
        'IHQS' => __DIR__,
        // your other namespaces
    );

Add ContactBundle to your application kernel
--------------------------------------------

::

    // app/AppKernel.php

    public function registerBundles()
    {
        return array(
            // ...
            new IHQS\GithubBundle\IHQSContactBundle(),
            // ...
        );
    }

Update your schema
------------------

::
    app/console doctrine:schema:update --force


Adding the form to your templates
---------------------------------

In your template, you just have to add (if you are using Twig)

::
    {% render "IHQSContactBundle:Contact:form" %}

Configuration
=============

In your app/config.yml (given you are using YAML for your configuration file)

::
    ihqs_contact.config:
        form: ~                                 # (optional) class managing the contact form
        model: ~                                # (optional) class managing the model
        connectors:                             # the list of "listeners" (or connectors here)
            email:                              # connecting the email listener
                recipients: contact@ihqs.net    # giving him the recipient(s) email(s)
            database:                           # connecting the database listener
                db_driver: orm                  # giving him the database driver
            file: ~                             # connecting the file logger listener

If you want a simple contact form only sending an email to you contact mailbox, then you just have to
add to your configuration file

::
    ihqs_contact.config:
        connectors:
            email:
                recipients: cont@ct.me
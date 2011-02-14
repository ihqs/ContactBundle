Provides a simple but powerful contact form built onto the Observer Pattern.
Plug any listener you want to your contact form's submission

# Todo

 * Add mongodb configuration files
 * Add unit tests
 * Comment methods and attributes

(Quite the same as for GithubBundle, we are sorry for that methodology but we'll correct that soon).

# Features

- Compatible with Doctrine ORM **and** ODM thanks to a generic repository.
- Model is extensible at will
- Observer Pattern designed for more flexibility
- Every class is customizable

# Installation

## Add ContactBundle to your src/ dir

<pre>
    $ git submodule add git://github.com/ihqs/ContactBundle.git    src/IHQS/ContactBundle
</pre>

If you want to connect the email listener, install SwitfMailer and configure it

<pre>
    $ git submodule add git://github.com/swiftmailer.git    src/vendor/swiftmailer
</pre>

In your config, add :

<pre>
    swiftmailer.config:
        transport:  smtp
        encryption: ssl
        auth_mode:  login
        host:       domain.tld
        username:   name@domain.tld
        password:   your_secret
</pre>



## Add the IHQS namespace to your autoloader

<pre>
    // app/autoload.php
    $loader->registerNamespaces(array(
        'IHQS' => __DIR__,
        // your other namespaces
    );
</pre>

## Add ContactBundle to your application kernel

<pre>
    // app/AppKernel.php

    public function registerBundles()
    {
        return array(
            // ...
            new IHQS\GithubBundle\IHQSContactBundle(),
            // ...
        );
    }
</pre>

## Update your schema

<pre>
    app/console doctrine:schema:update --force
</pre>


## Adding the form to your templates

In your template, you just have to add (if you are using Twig)

<pre>
    {% render "IHQSContactBundle:Contact:form" %}
</pre>

# Configuration

In your app/config.yml (given you are using YAML for your configuration file)

<pre>
    ihqs_contact.config:
        form: ~                                 # (optional) class managing the contact form
        model: ~                                # (optional) class managing the model
        connectors:                             # the list of "listeners" (or connectors here)
            email:                              # connecting the email listener
                recipients: contact@ihqs.net    # giving him the recipient(s) email(s)
            database:                           # connecting the database listener
                db_driver: orm                  # giving him the database driver
            file: ~                             # connecting the file logger listener
</pre>

If you want a simple contact form only sending an email to you contact mailbox, then you just have to
add to your configuration file

<pre>
    ihqs_contact.config:
        connectors:
            email:
                recipients: cont@ct.me
</pre>
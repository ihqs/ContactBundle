Provides a simple but powerful contact form built onto the Observer Pattern.
Plug any listener you want to your contact form's submission

# Todo

 * Add mongodb configuration files
 * Add unit tests
 * Comment methods and attributes
 * Cleanup

(Quite the same as for GithubBundle, we are sorry for that methodology but we'll correct that soon).

# Features

- Compatible with Doctrine ORM **and** ODM thanks to a generic repository.
- Model is extensible at will
- Observer Pattern designed for more flexibility
- Every class is customizable

# Installation

**Using submodules**
If you prefer instead to use git submodules, the run the following:

    $ git submodule add git://github.com/ihqs/ContactBundle.git    src/IHQS/ContactBundle

**Using the vendors script**

Add the following lines in your `deps` file:

    [IHQSContactBundle]
        git=git://github.com/ihqs/ContactBundle.git
        target=bundles/IHQS/ContactBundle

If you want to connect the email listener, install SwitfMailer and configure it

    $ git submodule add git://github.com/swiftmailer.git    src/vendor/swiftmailer

or via ``deps`` file

    [swiftmailer]
        git=http://github.com/swiftmailer/swiftmailer.git
        version=v4.1.2

In your config, add :

    swiftmailer.config:
        transport:  smtp
        encryption: ssl
        auth_mode:  login
        host:       domain.tld
        username:   name@domain.tld
        password:   your_secret

## Add the IHQS namespace to your autoloader

    // app/autoload.php
    $loader->registerNamespaces(array(
        'IHQS' => __DIR__.'/../vendor/bundles',
        // your other namespaces
    );

## Add ContactBundle to your application kernel

    // app/AppKernel.php
    public function registerBundles()
    {
        return array(
            // ...
            new IHQS\ContactBundle\IHQSContactBundle(),
            // ...
        );
    }

## Update your schema

    app/console doctrine:schema:update --force


## Adding the form to your templates

In your template, you just have to add (if you are using Twig)

    {% render "IHQSContactBundle:Contact:"~app.request.method with { 'msg': 'Thank you for your message!' }, { 'query': app.request.request.all } %}

Since version 2.0.13 of Symfony you must send your form "POST" data using "query" parameter.
That's because "render" tag is being processed as sub-request.
And since that version all sub-requests are forced to use "GET" method
therefore your embedded ContactController will loose all "POST" data if you miss it.
Also you can specify your custom success message using "msg" parameter.

# Configuration

In your app/config.yml (given you are using YAML for your configuration file)

    ihqs_contact:
        contact:
            form:
                type:               ihqs_contact_contact
                handler:            ihqs_contact.contact.form.handler.default
                name:               ihqs_contact_contact_form
                validation_groups:  [Contact]
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

    ihqs_contact:
        connectors:
            email:
                recipients: cont@ct.me

It you want to use a custom template/view instead of the default one (IHQSContactBundle:Contact:form.html.twig),
you can add the view parameter with the name of your view. Example:

	ihqs_contact:
	    contact:
	        form:
				view:               CompanyExampleBundle:Contact:form.html.twig


# Using Akismet for Spam Detection

skip the step if you dont want to check for spam, by default no spam will be detected.
Install the [OrnicarAkismentBundle](https://github.com/ornicar/OrnicarAkismetBundle) and configure it properly.
see the docs for more information.

define the service in your service container

    ihqs_contact:
        spam_detector:
            service: ornicar_akismet

now all your Contact Request will be checked by Akismet.

if you want to implement your own Detector simply set the class for the detector

    ihqs_contact:
        spam_detector:
            class: My\Bundle\MyDetector

note that the class should implement the ``SpamDetectorInterface``

or if you want a whole new service:

    ihqs_contact:
        spam_detector:
            service: my_detector_service



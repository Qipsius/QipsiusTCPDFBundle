QipsiusTCPDFBundle
=======================

This bundle is a fork of [WhiteOctoberTCPDFBundle](https://github.com/whiteoctober/WhiteOctoberTCPDFBundle)
This bundle facilitates easy use of the TCPDF PDF generation library in Symfony >= 6.0 applications.

For Symfony versions older than 6 use the 2.0 branch

Installation
------------

### Step 1: Setup Bundle and dependencies
```
composer require qipsius/tcpdf-bundle
```

#### Version constraining (optional)

By default, this bundle does not constrain the version of TCPDF that composer installs.
([An explanation of this unusual decision is here](https://github.com/whiteoctober/WhiteOctoberTCPDFBundle/issues/53)).
This means that a `composer update` could update to a new major version of TCPDF.
Since this bundle is only a thin wrapper around TCPDF, you can normally do such an upgrade without issue.

However, if you do wish to constrain the TCPDF version, find out what version you currently have installed with:

```bash
composer show tecnickcom/tcpdf
```

And amend your project's `composer.json` to add a TCPDF version constraint in the `requires` section.
For example, if TCPDF version `6.6.5` was installed, `"tecnickcom/tcpdf": "^6.6.5"` will allow anything < 7 when upgrading. 

### Step 2: Enable the bundle in the kernel

Add the bundle to the `registerBundles()` method in your kernel:

```php
// config/bundles.php
return [
    // ...
    Qipsius\TCPDFBundle\QipsiusTCPDFBundle::class => ['all' => true],
    // ...
];
```

(This project is not yet configured with Symfony Flex, so this change to `config/bundles.php` won't be done automatically.)

If you want to do service autowiring, you'll need to add an alias for the service:

```yaml
# config/services.yaml

services:
    # ...

    # the `qipsius.tcpdf` service will be injected when a
    # `Qipsius\TCPDFBundle\Controller\TCPDFController` type-hint is detected
    Qipsius\TCPDFBundle\Controller\TCPDFController: '@qipsius.tcpdf'
``` 

Using TCPDF
-----------

You can inject the `TCPDFController` service into your class

``` php
use Qipsius\TCPDFBundle\Controller\TCPDFController;

class PDFService
{
    protected TCPDFController $tcpdf;

    public function __construct(TCPDFController $tcpdf) 
    {
        $this->tcpdf = $tcpdf;
    }

   ...
}
```

From hereon in, you are using a TCPDF object to work with as normal.

Configuration
--------------

### Configuration values

You can pass parameters to TCPDF like this:

```yaml
# config/packages/qipsius_tcpdf.yaml

qipsius_tcpdf:
    tcpdf:
        k_title_magnification: 2
```

You can see the default parameter values in
`Qipsius\TCPDFBundle\DependencyInjection\Configuration::addTCPDFConfig`.

If you want, you can use TCPDF's own defaults instead:

```yaml
# config/packages/qipsius_tcpdf.yaml

qipsius_tcpdf:
    tcpdf:
        k_tcpdf_external_config: false  # the values set by this bundle will be ignored 
```

### Using a custom class

If you want to use your own custom TCPDF-based class, you can use
the `class` parameter in your configuration:

```yaml
# config/packages/qipsius_tcpdf.yaml

qipsius_tcpdf:
    class: '\App\Services\TCPDFService'
```

The class must extend from the `TCPDF` class; an exception will be
thrown if this is not the case.

License
-------

This bundle is under the MIT license. See the complete license in the bundle:

    Resources/meta/LICENSE

Contributing
-------------

We welcome contributions to this project, including pull requests and issues (and discussions on existing issues).

If you'd like to contribute code but aren't sure what, the [issues list](https://github.com/Qipsius/QipsiusTCPDFBundle/issues) is a good place to start.
If you're a first-time code contributor, you may find Github's guide to [forking projects](https://guides.github.com/activities/forking/) helpful.

All contributors (whether contributing code, involved in issue discussions, or involved in any other way) must abide by our [code of conduct](https://github.com/Qipsius/open-source-code-of-conduct/blob/master/code_of_conduct.md).

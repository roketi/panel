[![Latest Stable Version](https://poser.pugx.org/roketi/panel/v/stable.png)](https://packagist.org/packages/roketi/panel)
[![Total Downloads](https://poser.pugx.org/roketi/panel/downloads.png)](https://packagist.org/packages/roketi/panel)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/roketi/panel/badges/quality-score.png?s=740b19998383d480f55f2191cda9dd89f6a1e000)](https://scrutinizer-ci.com/g/roketi/panel/)
[![Code Coverage](https://scrutinizer-ci.com/g/roketi/panel/badges/coverage.png?s=3aab45c06dd9834ecd74ccb0e0931ff29ac48772)](https://scrutinizer-ci.com/g/roketi/panel/)
[![Dependency Status](https://www.versioneye.com/php/roketi:panel/dev-master/badge.png)](https://www.versioneye.com/php/roketi:panel/dev-master)
[![Build Status](https://travis-ci.org/roketi/panel.png)](https://travis-ci.org/roketi/panel)


### Submitting issues or seeking for work?

We manage our issues and tasks in JIRA, you can find our installation at https://roketi.atlassian.net/ - feel free to grab some work - or mention issues and bugs you've encountered.


### Running the Behat Tests

After installing Roketi Panel in your development environment, you need to run the following commands from the root of the installation to prepare your local Behat stuff::

	./flow behat:kickstart

After that, create a new database "roketi_testing" as the Behat tests are executed within a different Flow Context with it's own database configuration. Then execute the following command to prepare the database schema::

	FLOW_CONTEXT=Development/Behat ./flow doctrine:migrate

As the basic test needs to access protected functions it needs to be able to log in to the Roketi Panel instance. For this, a user needs to be created first with the following command::

	FLOW_CONTEXT=Development/Behat ./flow roketi.panel:setup:createadminuser --username john.doe --password 12345

The above mentioned steps will install the base to run any Behat test in your Roketi setup. The Roketi.Panel Package comes with it's own features that can be tested/executed with the following command::

	bin/behat -c Packages/Application/Roketi.Panel/Tests/Behavior/behat.yml

Important: The default URL in the config is http://roketi-panel.test/ - if your's differs, you need to changed that in the config file.
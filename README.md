[![Latest Stable Version](https://poser.pugx.org/roketi/panel/v/stable.png)](https://packagist.org/packages/roketi/panel)
[![Total Downloads](https://poser.pugx.org/roketi/panel/downloads.png)](https://packagist.org/packages/roketi/panel)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/roketi/panel/badges/quality-score.png?s=740b19998383d480f55f2191cda9dd89f6a1e000)](https://scrutinizer-ci.com/g/roketi/panel/)
[![Code Coverage](https://scrutinizer-ci.com/g/roketi/panel/badges/coverage.png?s=3aab45c06dd9834ecd74ccb0e0931ff29ac48772)](https://scrutinizer-ci.com/g/roketi/panel/)
[![Build Status](https://travis-ci.org/roketi/panel.png)](https://travis-ci.org/roketi/panel)

### Running the Behat Tests

After installing Roketi Panel in your development environment, you need to run the following commands from the root of the installation to prepare your local Behat stuff::

	./flow behat:kickstart

This will install all the neccessary stuff in ``/Build/Behat/``. The Roketi.Panel Package comes with it's own features that can be tested/executed with the following command::

	bin/behat -c Packages/Application/Roketi.Panel/Tests/Behavior/behat.yml

Important: The default URL in the config is http://roketi-panel.test/ - if your's differs, you need to changed that in the config file.
[![Latest Stable Version](https://poser.pugx.org/roketi/panel/v/stable.png)](https://packagist.org/packages/roketi/panel)
[![Total Downloads](https://poser.pugx.org/roketi/panel/downloads.png)](https://packagist.org/packages/roketi/panel)
[![Build Status](https://travis-ci.org/roketi/panel.png)](https://travis-ci.org/roketi/panel)

### Running the Behat Tests

After installing Roketi Panel in your development environment, you need to run the following commands from the root of the installation to prepare your local Behat stuff::

	./flow behat:kickstart

This will install all the neccessary stuff in ``/Build/Behat/``. The Roketi.Panel Package comes with it's own features that can be tested/executed with the following command::

	bin/behat -c Packages/Application/Roketi.Panel/Tests/Behavior/behat.yml

Important: The default URL in the config is http://roketi-panel.dev/ - if your's differs, you need to changed that in the config file.
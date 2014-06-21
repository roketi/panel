Feature: Creating a domain
  As an administrator I want to be able to create a domain in order to start hosting something.

  Scenario: Anonymous user cannot see the list of domains
    Given I am on "/domain/"
    Then I should be on "/login"

  @fixtures
  Scenario: Logged in user can reach list of domains via navigation
    Given I am logged in as "john.doe" with password "12345"
    And I go to "/dashboard/"
    When I follow "Domain"
    Then I should be on "/domain"

  @fixtures
  Scenario: Logged in user sees an empty domain list at first
    Given I am logged in as "john.doe" with password "12345"
    When I go to "/domain/"
    Then I should see "There are no domains created yet."

  @fixtures
  Scenario: Creating a domain works
    Given I am logged in as "john.doe" with password "12345"
    When I go to "/domain/"
    And I follow "Create new Domain"
    Then I should be on "/domain/new"
    When I fill in "foobar.ch" for "newDomainName"
    And press "Create Domain"
    Then I should be on "/domain"
    And I should see "Domain created successfully!"
    And I should see "foobar.ch"

  @fixtures
  Scenario: Creating existing domain again fails
    Given I am logged in as "john.doe" with password "12345"
    And there is a domain "foobar.ch"
    When I go to "/domain/new"
    And I fill in "foobar.ch" for "newDomainName"
    And press "Create Domain"
    Then I should see "Another entity with the same unique identifiers already exists"

@fixtures
  Scenario: Creating a domain with an invalid name is denied and an error is shown
    Given I am logged in as "john.doe" with password "12345"
    When I go to "/domain/new"
    And I fill in "this_is_invalid.demo.example.org" for "newDomainName"
    And press "Create Domain"
    Then I should be on "/domain/create"
    And I should see "The entered domain name is invalid!"
    And I should see "this_is_invalid.demo.example.org"

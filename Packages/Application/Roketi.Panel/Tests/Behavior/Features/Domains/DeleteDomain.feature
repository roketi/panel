@new
Feature: Delete a domain
  As an administrator I want to be able to delete a domain.

  @fixtures
  Scenario: Empty domain list does not show delete links
    Given I am logged in as "john.doe" with password "12345"
    And I go to "/domain"
    Then I should not see "delete"

  @fixtures
  Scenario: Logged in admin user can see a delete button
    Given I am logged in as "john.doe" with password "12345"
    And there is a domain "foobar.ch"
    When I go to "/domain/"
    Then I should see "delete"
    When I press "delete"
    Then I should be on "/domain"
    And I should see "Domain deleted successfully!"
    And I should not see "foobar.ch"

  @fixtures
  Scenario: Deletion of new domain is logged
    Given I am logged in as "john.doe" with password "12345"
    And there is a domain "foobar.ch"
    When I go to "/log/"
    Then I should not see "Domain deleted"
    When I go to "/domain"
    And I press "delete"
    And I go to "/log/"
    Then I should see "Domain deleted"

Feature: Logging Authentication (login/logout)
  As an administrator I want to be able to see which user has logged in and logged out of the application


  Scenario: Anonymous user cannot see the logs
    Given I am on "/log/"
    Then I should be on "/login"


  Scenario: User logins are logged and can be listed
    Given I am logged in as "john.doe" with password "12345"
    When I go to "/log/"
    Then I should see "User john.doe logged in"
    Then I should not see "User john.doe logged out"


  Scenario: User logouts are logged and can be listed
    Given I am logged in as "john.doe" with password "12345"
    When I follow "logout"
    And I am logged in as "john.doe" with password "12345"
    When I go to "/log/"
    Then I should see "User john.doe logged out"


  Scenario: Failed login attempts are logged, too
    Given I am on "/login"
    And  I am logged in as "john.doe" with password "invalid"
    When  I am logged in as "john.doe" with password "12345"
    And I go to "/log"
    Then I should see "Failed login attempt"
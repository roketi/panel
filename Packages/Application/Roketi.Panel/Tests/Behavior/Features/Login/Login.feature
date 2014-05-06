Feature: User Login
  As an administator I want to login to the System

  Scenario: Dashboard is not accessible before logging in
    Given I am on "/dashboard"
    Then I should be on "/login"
    And I should see a login form

  Scenario: Opening the application in a fresh session redirects to login form
    Given I am not logged in
    When I go to "/"
    Then I should be on "/login"

  Scenario: The login page shows a login form
    Given I am on "/login"
    Then I should see a login form

  Scenario: Successful login with valid user data
    Given I am on "/"
    When I fill in "username" with "john.doe"
    When I fill in "password" with "12345"
    When I press "login"
    Then I should be on "/dashboard"
    And I should see "Login successful"
    And I should be logged in as "john.doe"
    And I should see "Logout"


  Scenario: Successful login with valid user data
    Given I am on "/login"
    When I fill in "username" with "john.doe"
    When I fill in "password" with "12345"
    When I press "login"
    Then I should be on "/dashboard"
    And I should see "Login successful"
    And I should be logged in as "john.doe"
    And I should see "Logout"

  Scenario: Failed login with invalid user data
    Given I am on "/login"
    When I fill in "username" with "john.doe"
    When I fill in "password" with "invalidpass"
    When I press "login"
    Then I should be on "/login"
    And I should not be logged in
    And I should see "Login failed"

  Scenario: Submitting empty login form shows error, too
    Given I am on "/login"
    When I press "login"
    Then I should be on "/login"
    And I should not be logged in
    And I should see "Login failed"

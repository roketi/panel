Feature: User Logout
  As an administator I want to logout from the system

  Scenario: Logout works if called when not logged in
    Given I am on "/login/logout"
    Then I should be on "/login"
    And I should see a login form

  Scenario: Successful login with valid user data then directly logging out again
    Given I am logged in as "john.doe" with password "12345"
    Then I should be on "/dashboard"
    When I follow "Logout"
    Then I should see "Goodbye, you logged out successfully"
    And I should be on "/login"

Feature: User Logout
  As an administator I want to logout from the system

  Scenario: Successful login with valid user data then directly logging out again
    Given I am logged in as "john.doe" with password "12345"
    Then I should be on "/dashboard"
    When I follow "logout"
    Then I should see "Goodbye, you logged out successfully"
    And I should be on "/login"

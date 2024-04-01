context('Refresh Proses Preparation', () => {
  const loginUser = (email, password) => {
    cy.get('#email').type(email);
    cy.get('#password').type(password);
    cy.get('form').submit();
  };

  beforeEach(() => {
    const url = 'http://localhost:8000/home';
    cy.log(`Visiting URL: ${url}`);
    cy.visit(url);
  });

  it('Refresh Proses Preparation', () => {
    loginUser("admin@gmail.com", "admin");
    cy.url().should('include', '/home');

    cy.visit('http://localhost:8000/data-pa-841w');
  
    cy.get('a.btn.btn-default.mr-2').contains('Proses').click();

    cy.contains('Refresh').click();

  });
});

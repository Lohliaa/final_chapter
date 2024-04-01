context('Download Proses Final', () => {
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

  it('Download Proses Final', () => {
    loginUser("admin@gmail.com", "admin");
    cy.url().should('include', '/home');

    cy.visit('http://localhost:8000/data-fa-841w');
  
    cy.get('a.btn.btn-default.mr-2').contains('Proses').click();

    cy.contains('Download Excel').click();
  });
});

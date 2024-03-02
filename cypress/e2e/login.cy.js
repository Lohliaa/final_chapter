context('Login', () => {
  const loginUser = (email, password) => {
    cy.get('#email').type(email);
    cy.get('#password').type(password);
    cy.get('form').submit();
  };

  beforeEach(() => {
    const url = 'http://localhost:8000/home'; // Ganti dengan URL yang sesuai
    cy.log(`Visiting URL: ${url}`);
    cy.visit(url);
  });

  it('Success Login', () => {
    loginUser("admin@gmail.com", "admin");
    cy.url().should('include', '/home');
  });
}); 

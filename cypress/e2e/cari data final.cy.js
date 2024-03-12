context('Cari Data Final', () => {
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

  it('Cari Data', () => {
    loginUser("admin@gmail.com", "admin");
    cy.url().should('include', '/home');

    cy.visit('http://localhost:8000/data-fa-841w');

    // Pencarian data pada field search
    const searchText = 'YY15';
    cy.get('#searchfa_1c').type(searchText); 
  });
});

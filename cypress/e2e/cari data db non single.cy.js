context('Cari Data Properti Non Single', () => {
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

    cy.visit('http://localhost:8000/properti_nonsingle');

    // Pencarian data pada field search
    const searchText = 'ROTATE 11 ';
    cy.get('#searchnp').type(searchText); 
  });
});

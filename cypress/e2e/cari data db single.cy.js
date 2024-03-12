context('Cari Data Circuit Single', () => {
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

    cy.visit('http://localhost:8000/konsep_commonize');

    // Pencarian data YY05 pada field search
    const searchText = 'YY05';
    cy.get('#searchk').type(searchText);
  });
});

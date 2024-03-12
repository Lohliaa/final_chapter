context('Cari Data Item', () => {
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

    cy.visit('http://localhost:8000/item_list');

    // Pencarian data NBA 0.5 R pada field search
    const searchText = 'NBA 0.5 R'; 
    cy.get('#searchil').type(searchText);
  });
});

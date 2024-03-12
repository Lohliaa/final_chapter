context('Cari Proses Material', () => {
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

  it('Cari Proses Material', () => {
    loginUser("admin@gmail.com", "admin");
    cy.url().should('include', '/home');

    cy.visit('http://localhost:8000/material');

    // Klik tombol "Proses"
    cy.contains('Proses').click();

    cy.visit('http://localhost:8000/proses_material');

    const searchText = 'SULVUS 0.5 La-Br';
    cy.get('#searchpm').type(searchText); 

  });
});

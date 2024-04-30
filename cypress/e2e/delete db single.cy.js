context('Delete Properti Single', () => {
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

  it('Delete Data', () => {
    loginUser("admin@gmail.com", "admin");
    cy.url().should('include', '/home');

    cy.visit('http://localhost:8000/properti_single');

    // Pilih checkbox pertama
    cy.get('.sub_chk').eq(1).check();

    // Klik tombol "Delete"
    cy.contains('Delete').click();

  });

});

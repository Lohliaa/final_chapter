context('Cari Data Proses Final', () => {
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

  it('Cari Data Proses Final', () => {
    loginUser("admin@gmail.com", "admin");
    cy.url().should('include', '/home');

    cy.visit('http://localhost:8000/area_final');
  
    cy.get('a.btn.btn-default.mr-2').contains('Proses').click();

    const searchText = 'YY13';
    cy.get('#searchproses').type(searchText); 

  });
});

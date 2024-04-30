context('Manual Book', () => {
  const loginUser = (email, password) => {
    cy.get('#email').type(email);
    cy.get('#password').type(password);
    cy.get('form').submit();
  };

  // untuk mengunduh "Manual Book". Mengambil URL dari tautan ("a") dengan judul "Manual Book"
  const downloadManualBook = () => {
    cy.get('a[title="Manual Book"]').invoke('attr', 'href').then((manualBookUrl) => {
      cy.log(`Downloading Manual Book from URL: ${manualBookUrl}`);
      cy.request(manualBookUrl).then((response) => { 
        cy.log(`Download successful!`);
      });
    });
  };

  beforeEach(() => {
    const url = 'http://localhost:8000/home';
    cy.log(`Visiting URL: ${url}`);
    cy.visit(url);
  });

  it('Success Login and Download Manual Book', () => {
    loginUser("admin@gmail.com", "admin");
    cy.url().should('include', '/home');

    downloadManualBook();
  });
});

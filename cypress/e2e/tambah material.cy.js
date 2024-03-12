context('Tambah Material', () => {
  // untuk mengisi formulir login dan password lalu mengirim formulir
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

  it('Tambah Material', () => {
    loginUser("admin@gmail.com", "admin");
    cy.url().should('include', '/home');

    cy.visit('http://localhost:8000/material');
    cy.wait(1000);

    // Cari berdasarkan teks
    cy.contains('Tambah').click();

    // Temukan elemen formulir dan isi dengan data yang diberikan
    cy.get('label:contains("Factory") + input').first().type('PT XXX');
    cy.get('label:contains("Code") + input').first().type('AREA 07');
    cy.get('label:contains("Cavity") + input').first().type('AREA 07');
    cy.get('label:contains("Area") + input').first().type('SH22L-10');
    cy.get('label:contains("Part Number") + input').first().type('SULVUS 0.5 La');
    cy.get('label:contains("Part Name") + input').first().type('-');
    cy.get('label:contains("QTY Total") + input').first().type('700');

    // Klik tombol SIMPAN
    cy.get('button.btn-success').click();

  });
});
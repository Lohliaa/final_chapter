context('Tambah Database Konversi', () => {
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

  it('Tambah Database Konversi', () => {
    loginUser("admin@gmail.com", "admin");
    cy.url().should('include', '/home');

    cy.visit('http://localhost:8000/database_konversi');
    cy.wait(1000);

    // Cari berdasarkan teks
    cy.contains('Tambah').click();

    // Temukan elemen formulir dan isi dengan data yang diberikan
    cy.get('label:contains("Part Number") + input').first().type('PATC-TR 13');
    cy.get('label:contains("Item") + input').first().type('430411041');
    cy.get('label:contains("Part Name") + input').first().type('TAPE');
    cy.get('label:contains("Satuan") + input').first().type('METER');
    cy.get('label:contains("Inner Packing") + input').first().type('11');

    // Klik tombol SIMPAN
    cy.get('button.btn-success').click();

  });
});
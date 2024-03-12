context('Tambah Data Area Final', () => {
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

  it('Tambah Data Area Final', () => {
    loginUser("admin@gmail.com", "admin");
    cy.url().should('include', '/home');

    cy.visit('http://localhost:8000/data-fa-841w');
    cy.wait(1000);

    // Cari berdasarkan teks
    cy.contains('Tambah').click();

    // Temukan elemen formulir dan isi dengan data yang diberikan
    cy.get('label:contains("Line") + input').first().type('114A');
    cy.get('label:contains("Bagian") + input').first().type('7A');
    cy.get('label:contains("Area Store") + input').first().type('-');
    cy.get('label:contains("Material") + input').first().type('YY11');
    cy.get('label:contains("Warna") + input').first().type('R');
    cy.get('label:contains("Qty Board") + input').first().type('0');
    cy.get('label:contains("Issue") + input').first().type('0');
    cy.get('label:contains("Total QTY") + input').first().type('57');
    cy.get('label:contains("Housing") + input').first().type('A 08');
    cy.get('label:contains("Month") + input').first().type('September');
    cy.get('label:contains("Year") + input').first().type('2023');
    cy.get('label:contains("Factory") + input').first().type('PT XXX');

    // Klik tombol SIMPAN
    cy.get('button.btn-success').click();

  });
});
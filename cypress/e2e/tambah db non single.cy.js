context('Tambah Circuit Non Single', () => {
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

  it('Tambah Data', () => {
    loginUser("admin@gmail.com", "admin");
    cy.url().should('include', '/home');

    cy.visit('http://localhost:8000/next_proses');
    cy.wait(1000);

    // Cari berdasarkan teks
    cy.contains('Tambah').click();

    cy.get('label:contains("Line") + input').first().type('114A');
    cy.get('label:contains("Tipe") + input').first().type('RC-03');
    cy.get('label:contains("Jenis") + input').first().type('ROTATE');
    cy.get('label:contains("Material") + input').first().type('10');
    cy.get('label:contains("Jenis Material") + input').first().type('ROTATE 10');
    cy.get('label:contains("Material Properties") + input').first().type('YY15');
    cy.get('label:contains("Model") + input').first().type('NBA');
    cy.get('label:contains("Ukuran") + input').first().type('0.5');
    cy.get('label:contains("Warna") + input').first().type('W-B');
    cy.get('label:contains("Model Ukuran Warna") + input').first().type('NBA 0.5 W-B');
    cy.get('label:contains("Specific Part Numb") + input').first().type('2801R706942');
    cy.get('label:contains("CL") + input').first().type('134');
    cy.get('label:contains("Terminal B") + input').first().type('SOLDER0');
    cy.get('label:contains("Acc bag b1") + input').first().type('Z092-1153-15');
    cy.get('label:contains("Acc bag b2") + input').first().type('-');
    cy.get('label:contains("Tube B") + input').first().type('0097-3358-00');
    cy.get('label:contains("Terminal A") + input').first().type('0411-1697-20');
    cy.get('label:contains("Acc bag a1") + input').first().type('0100-6923-17');
    cy.get('label:contains("Acc bag a2") + input').first().type('-');
    cy.get('label:contains("Tube A") + input').first().type('0097-3358-00');

    // Klik tombol SIMPAN
    cy.get('button.btn-success').click(); 
  }); 
});

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBancosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bancos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bcra_id');
            $table->string('nombre',100);
            $table->string('logo',30);
            $table->timestamps();
        });

        DB::insert("INSERT IGNORE INTO `bancos` (`id`, `bcra_id`, `nombre`, `created_at`, `updated_at`) VALUES
            (1, 7, 'BANCO DE GALICIA Y BUENOS AIRES S.A.', NULL, NULL),
            (2, 11, 'BANCO DE LA NACION ARGENTINA', NULL, NULL),
            (3, 14, 'BANCO DE LA PROVINCIA DE BUENOS AIRES', NULL, NULL),
            (4, 15, 'INDUSTRIAL AND COMMERCIAL BANK OF CHINA', NULL, NULL),
            (5, 16, 'CITIBANK N.A.', NULL, NULL),
            (6, 17, 'BBVA BANCO FRANCES S.A.', NULL, NULL),
            (7, 18, 'THE BANK OF TOKYO-MITSUBISHI UFJ, LTD.', NULL, NULL),
            (8, 20, 'BANCO DE LA PROVINCIA DE CORDOBA S.A.', NULL, NULL),
            (9, 27, 'BANCO SUPERVIELLE S.A.', NULL, NULL),
            (10, 29, 'BANCO DE LA CIUDAD DE BUENOS AIRES', NULL, NULL),
            (11, 34, 'BANCO PATAGONIA S.A.', NULL, NULL),
            (12, 44, 'BANCO HIPOTECARIO S.A.', NULL, NULL),
            (13, 45, 'BANCO DE SAN JUAN S.A.', NULL, NULL),
            (14, 60, 'BANCO DEL TUCUMAN S.A.', NULL, NULL),
            (15, 65, 'BANCO MUNICIPAL DE ROSARIO', NULL, NULL),
            (16, 72, 'BANCO SANTANDER RIO S.A.', NULL, NULL),
            (17, 83, 'BANCO DEL CHUBUT S.A.', NULL, NULL),
            (18, 86, 'BANCO DE SANTA CRUZ S.A.', NULL, NULL),
            (19, 93, 'BANCO DE LA PAMPA SOCIEDAD DE ECONOMÍA M', NULL, NULL),
            (20, 94, 'BANCO DE CORRIENTES S.A.', NULL, NULL),
            (21, 97, 'BANCO PROVINCIA DEL NEUQUÉN SOCIEDAD ANÓ', NULL, NULL),
            (22, 147, 'BANCO INTERFINANZAS S.A.', NULL, NULL),
            (23, 150, 'HSBC BANK ARGENTINA S.A.', NULL, NULL),
            (24, 165, 'JPMORGAN CHASE BANK, NATIONAL ASSOCIATIO', NULL, NULL),
            (25, 191, 'BANCO CREDICOOP COOPERATIVO LIMITADO', NULL, NULL),
            (26, 198, 'BANCO DE VALORES S.A.', NULL, NULL),
            (27, 247, 'BANCO ROELA S.A.', NULL, NULL),
            (28, 254, 'BANCO MARIVA S.A.', NULL, NULL),
            (29, 259, 'BANCO ITAU ARGENTINA S.A.', NULL, NULL),
            (30, 262, 'BANK OF AMERICA, NATIONAL ASSOCIATION', NULL, NULL),
            (31, 266, 'BNP PARIBAS', NULL, NULL),
            (32, 268, 'BANCO PROVINCIA DE TIERRA DEL FUEGO', NULL, NULL),
            (33, 269, 'BANCO DE LA REPUBLICA ORIENTAL DEL URUGU', NULL, NULL),
            (34, 277, 'BANCO SAENZ S.A.', NULL, NULL),
            (35, 281, 'BANCO MERIDIAN S.A.', NULL, NULL),
            (36, 285, 'BANCO MACRO S.A.', NULL, NULL),
            (37, 299, 'BANCO COMAFI SOCIEDAD ANONIMA', NULL, NULL),
            (38, 300, 'BANCO DE INVERSION Y COMERCIO EXTERIOR S', NULL, NULL),
            (39, 301, 'BANCO PIANO S.A.', NULL, NULL),
            (40, 303, 'BANCO FINANSUR S.A.', NULL, NULL),
            (41, 305, 'BANCO JULIO SOCIEDAD ANONIMA', NULL, NULL),
            (42, 309, 'BANCO RIOJA SOCIEDAD ANONIMA UNIPERSONAL', NULL, NULL),
            (43, 310, 'BANCO DEL SOL S.A.', NULL, NULL),
            (44, 311, 'NUEVO BANCO DEL CHACO S. A.', NULL, NULL),
            (45, 312, 'BANCO VOII S.A.', NULL, NULL),
            (46, 315, 'BANCO DE FORMOSA S.A.', NULL, NULL),
            (47, 319, 'BANCO CMF S.A.', NULL, NULL),
            (48, 321, 'BANCO DE SANTIAGO DEL ESTERO S.A.', NULL, NULL),
            (49, 322, 'BANCO INDUSTRIAL S.A.', NULL, NULL),
            (50, 330, 'NUEVO BANCO DE SANTA FE SOCIEDAD ANONIMA', NULL, NULL),
            (51, 331, 'BANCO CETELEM ARGENTINA S.A.', NULL, NULL),
            (52, 332, 'BANCO DE SERVICIOS FINANCIEROS S.A.', NULL, NULL),
            (53, 336, 'BANCO BRADESCO ARGENTINA S.A.U.', NULL, NULL),
            (54, 338, 'BANCO DE SERVICIOS Y TRANSACCIONES S.A.', NULL, NULL),
            (55, 339, 'RCI BANQUE S.A.', NULL, NULL),
            (56, 340, 'BACS BANCO DE CREDITO Y SECURITIZACION S', NULL, NULL),
            (57, 341, 'BANCO MASVENTAS S.A.', NULL, NULL),
            (58, 386, 'NUEVO BANCO DE ENTRE RÍOS S.A.', NULL, NULL),
            (59, 389, 'BANCO COLUMBIA S.A.', NULL, NULL),
            (60, 426, 'BANCO BICA S.A.', NULL, NULL),
            (61, 431, 'BANCO COINAG S.A.', NULL, NULL),
            (62, 432, 'BANCO DE COMERCIO S.A.', NULL, NULL),
            (63, 44059, 'FORD CREDIT COMPAÑIA FINANCIERA S.A.', NULL, NULL),
            (64, 44077, 'COMPAÑIA FINANCIERA ARGENTINA S.A.', NULL, NULL),
            (65, 44088, 'VOLKWAGEN FINANCIAL SERVICES CIA.FIN.S.A', NULL, NULL),
            (66, 44090, 'CORDIAL COMPAÑÍA FINANCIERA S.A.', NULL, NULL),
            (67, 44092, 'FCA COMPAÑIA FINANCIERA S.A.', NULL, NULL),
            (68, 44093, 'GPAT COMPAÑIA FINANCIERA S.A.', NULL, NULL),
            (69, 44094, 'MERCEDES-BENZ COMPAÑÍA FINANCIERA ARGENT', NULL, NULL),
            (70, 44095, 'ROMBO COMPAÑÍA FINANCIERA S.A.', NULL, NULL),
            (71, 44096, 'JOHN DEERE CREDIT COMPAÑÍA FINANCIERA S.', NULL, NULL),
            (72, 44098, 'PSA FINANCE ARGENTINA COMPAÑÍA FINANCIER', NULL, NULL),
            (73, 44099, 'TOYOTA COMPAÑÍA FINANCIERA DE ARGENTINA', NULL, NULL),
            (74, 44100, 'FINANDINO COMPAÑIA FINANCIERA S.A.', NULL, NULL),
            (75, 45056, 'MONTEMAR COMPAÑIA FINANCIERA S.A.', NULL, NULL),
            (76, 45072, 'MULTIFINANZAS COMPAÑIA FINANCIERA S.A.', NULL, NULL),
            (77, 65203, 'CAJA DE CREDITO CUENCA COOPERATIVA LIM', NULL, NULL);");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bancos');
    }
}

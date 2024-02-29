﻿using System;
using System.Collections.Generic;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace MiSistema.Entidades
{
    public class clsPersonaBE
    {
        public int idPersona { get; set; }
        public string Paterno { get; set; }
        public string Materno { get; set; }
        public string Nombre { get; set; }
        public string NroDocumento { get; set; }
        public DateTime FechaNacimiento { get; set; }
        public string Celular { get; set; }
        public string CorreoElectronico { get; set; }
        public int IdTipoPersona { get; set; }
    }
}

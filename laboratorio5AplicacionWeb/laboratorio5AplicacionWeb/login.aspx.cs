using MiSistema.Entidades;
using MiSistema.Negocios;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace laboratorio5AplicacionWeb
{
    public partial class login : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {

        }

        protected void btnAutentica_Click(object sender, EventArgs e)
        {
            Usuario oclsUsuario = new Usuario();
            clsUsuarioBE oclsUsuarioBE =
                oclsUsuario.Autenticar(TextBox1.Text, TextBox2.Text);
            
            if (oclsUsuarioBE.IdUsuario > 0)
            {
                Server.Transfer("./Default.aspx");

            }
            //else
            //{
            //    MessageBox.Show("credenciales invalidass");
            //}

        }
    }
}
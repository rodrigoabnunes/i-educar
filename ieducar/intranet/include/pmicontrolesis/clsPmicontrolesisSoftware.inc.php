<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
*                                                                        *
*   @author Prefeitura Municipal de Itajaí                               *
*   @updated 29/03/2007                                                  *
*   Pacote: i-PLB Software Público Livre e Brasileiro                    *
*                                                                        *
*   Copyright (C) 2006  PMI - Prefeitura Municipal de Itajaí             *
*                       ctima@itajai.sc.gov.br                           *
*                                                                        *
*   Este  programa  é  software livre, você pode redistribuí-lo e/ou     *
*   modificá-lo sob os termos da Licença Pública Geral GNU, conforme     *
*   publicada pela Free  Software  Foundation,  tanto  a versão 2 da     *
*   Licença   como  (a  seu  critério)  qualquer  versão  mais  nova.    *
*                                                                        *
*   Este programa  é distribuído na expectativa de ser útil, mas SEM     *
*   QUALQUER GARANTIA. Sem mesmo a garantia implícita de COMERCIALI-     *
*   ZAÇÃO  ou  de ADEQUAÇÃO A QUALQUER PROPÓSITO EM PARTICULAR. Con-     *
*   sulte  a  Licença  Pública  Geral  GNU para obter mais detalhes.     *
*                                                                        *
*   Você  deve  ter  recebido uma cópia da Licença Pública Geral GNU     *
*   junto  com  este  programa. Se não, escreva para a Free Software     *
*   Foundation,  Inc.,  59  Temple  Place,  Suite  330,  Boston,  MA     *
*   02111-1307, USA.                                                     *
*                                                                        *
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
/**
* @author Prefeitura Municipal de Itajaí
*
* Criado em 27/03/2007 11:40 pelo gerador automatico de classes
*/

require_once( "include/pmicontrolesis/geral.inc.php" );

class clsPmicontrolesisSoftware
{
    var $cod_software;
    var $ref_funcionario_exc;
    var $ref_funcionario_cad;
    var $nm_software;
    var $data_cadastro;
    var $data_exclusao;
    var $ativo;

    // propriedades padrao

    /**
     * Armazena o total de resultados obtidos na ultima chamada ao metodo lista
     *
     * @var int
     */
    var $_total;

    /**
     * Nome do schema
     *
     * @var string
     */
    var $_schema;

    /**
     * Nome da tabela
     *
     * @var string
     */
    var $_tabela;

    /**
     * Lista separada por virgula, com os campos que devem ser selecionados na proxima chamado ao metodo lista
     *
     * @var string
     */
    var $_campos_lista;

    /**
     * Lista com todos os campos da tabela separados por virgula, padrao para selecao no metodo lista
     *
     * @var string
     */
    var $_todos_campos;

    /**
     * Valor que define a quantidade de registros a ser retornada pelo metodo lista
     *
     * @var int
     */
    var $_limite_quantidade;

    /**
     * Define o valor de offset no retorno dos registros no metodo lista
     *
     * @var int
     */
    var $_limite_offset;

    /**
     * Define o campo padrao para ser usado como padrao de ordenacao no metodo lista
     *
     * @var string
     */
    var $_campo_order_by;


    /**
     * Construtor (PHP 4)
     * 
     * @param integer cod_software
     * @param integer ref_funcionario_exc
     * @param integer ref_funcionario_cad
     * @param string nm_software
     * @param string data_cadastro
     * @param string data_exclusao
     * @param bool ativo
     *
     * @return object
     */
    function __construct( $cod_software = null, $ref_funcionario_exc = null, $ref_funcionario_cad = null, $nm_software = null, $data_cadastro = null, $data_exclusao = null, $ativo = null )
    {
        $db = new clsBanco();
        $this->_schema = "pmicontrolesis.";
        $this->_tabela = "{$this->_schema}software";

        $this->_campos_lista = $this->_todos_campos = "cod_software, ref_funcionario_exc, ref_funcionario_cad, nm_software, data_cadastro, data_exclusao, ativo";

        if( is_numeric( $ref_funcionario_exc ) )
        {
            if( class_exists( "clsFuncionario" ) )
            {
                $tmp_obj = new clsFuncionario( $ref_funcionario_exc );
                if( method_exists( $tmp_obj, "existe") )
                {
                    if( $tmp_obj->existe() )
                    {
                        $this->ref_funcionario_exc = $ref_funcionario_exc;
                    }
                }
                else if( method_exists( $tmp_obj, "detalhe") )
                {
                    if( $tmp_obj->detalhe() )
                    {
                        $this->ref_funcionario_exc = $ref_funcionario_exc;
                    }
                }
            }
            else
            {
                if( $db->CampoUnico( "SELECT 1 FROM funcionario WHERE ref_cod_pessoa_fj = '{$ref_funcionario_exc}'" ) )
                {
                    $this->ref_funcionario_exc = $ref_funcionario_exc;
                }
            }
        }
        if( is_numeric( $ref_funcionario_cad ) )
        {
            if( class_exists( "clsFuncionario" ) )
            {
                $tmp_obj = new clsFuncionario( $ref_funcionario_cad );
                if( method_exists( $tmp_obj, "existe") )
                {
                    if( $tmp_obj->existe() )
                    {
                        $this->ref_funcionario_cad = $ref_funcionario_cad;
                    }
                }
                else if( method_exists( $tmp_obj, "detalhe") )
                {
                    if( $tmp_obj->detalhe() )
                    {
                        $this->ref_funcionario_cad = $ref_funcionario_cad;
                    }
                }
            }
            else
            {
                if( $db->CampoUnico( "SELECT 1 FROM funcionario WHERE ref_cod_pessoa_fj = '{$ref_funcionario_cad}'" ) )
                {
                    $this->ref_funcionario_cad = $ref_funcionario_cad;
                }
            }
        }


        if( is_numeric( $cod_software ) )
        {
            $this->cod_software = $cod_software;
        }
        if( is_string( $nm_software ) )
        {
            $this->nm_software = $nm_software;
        }
        if( is_string( $data_cadastro ) )
        {
            $this->data_cadastro = $data_cadastro;
        }
        if( is_string( $data_exclusao ) )
        {
            $this->data_exclusao = $data_exclusao;
        }
        if( ! is_null( $ativo ) )
        {
            $this->ativo = $ativo;
        }

    }

    /**
     * Cria um novo registro
     *
     * @return bool
     */
    function cadastra()
    {
        if( is_numeric( $this->ref_funcionario_cad ) && is_string( $this->nm_software ) )
        {
            $db = new clsBanco();

            $campos = "";
            $valores = "";
            $gruda = "";

            if( is_numeric( $this->ref_funcionario_cad ) )
            {
                $campos .= "{$gruda}ref_funcionario_cad";
                $valores .= "{$gruda}'{$this->ref_funcionario_cad}'";
                $gruda = ", ";
            }
            if( is_string( $this->nm_software ) )
            {
                $campos .= "{$gruda}nm_software";
                $valores .= "{$gruda}'{$this->nm_software}'";
                $gruda = ", ";
            }
            $campos .= "{$gruda}data_cadastro";
            $valores .= "{$gruda}NOW()";
            $gruda = ", ";
            $campos .= "{$gruda}ativo";
            $valores .= "{$gruda}'1'";
            $gruda = ", ";


            $db->Consulta( "INSERT INTO {$this->_tabela} ( $campos ) VALUES( $valores )" );
            return $db->InsertId( "{$this->_tabela}_cod_software_seq");
        }
        return false;
    }

    /**
     * Edita os dados de um registro
     *
     * @return bool
     */
    function edita()
    {
        if( is_numeric( $this->cod_software ) && is_numeric( $this->ref_funcionario_exc ) )
        {

            $db = new clsBanco();
            $set = "";

            if( is_numeric( $this->ref_funcionario_exc ) )
            {
                $set .= "{$gruda}ref_funcionario_exc = '{$this->ref_funcionario_exc}'";
                $gruda = ", ";
            }
            if( is_numeric( $this->ref_funcionario_cad ) )
            {
                $set .= "{$gruda}ref_funcionario_cad = '{$this->ref_funcionario_cad}'";
                $gruda = ", ";
            }
            if( is_string( $this->nm_software ) )
            {
                $set .= "{$gruda}nm_software = '{$this->nm_software}'";
                $gruda = ", ";
            }
            if( is_string( $this->data_cadastro ) )
            {
                $set .= "{$gruda}data_cadastro = '{$this->data_cadastro}'";
                $gruda = ", ";
            }
            $set .= "{$gruda}data_exclusao = NOW()";
            $gruda = ", ";
            if( ! is_null( $this->ativo ) )
            {
                $val = dbBool( $this->ativo ) ? "TRUE": "FALSE";
                $set .= "{$gruda}ativo = {$val}";
                $gruda = ", ";
            }


            if( $set )
            {
                $db->Consulta( "UPDATE {$this->_tabela} SET $set WHERE cod_software = '{$this->cod_software}'" );
                return true;
            }
        }
        return false;
    }

    /**
     * Retorna uma lista filtrados de acordo com os parametros
     * 
     * @param integer int_ref_funcionario_exc
     * @param integer int_ref_funcionario_cad
     * @param string str_nm_software
     * @param string date_data_cadastro_ini
     * @param string date_data_cadastro_fim
     * @param string date_data_exclusao_ini
     * @param string date_data_exclusao_fim
     * @param bool bool_ativo
     *
     * @return array
     */
    function lista( $int_ref_funcionario_exc = null, $int_ref_funcionario_cad = null, $str_nm_software = null, $date_data_cadastro_ini = null, $date_data_cadastro_fim = null, $date_data_exclusao_ini = null, $date_data_exclusao_fim = null, $bool_ativo = null )
    {
        $sql = "SELECT {$this->_campos_lista} FROM {$this->_tabela}";
        $filtros = "";

        $whereAnd = " WHERE ";

        if( is_numeric( $int_cod_software ) )
        {
            $filtros .= "{$whereAnd} cod_software = '{$int_cod_software}'";
            $whereAnd = " AND ";
        }
        if( is_numeric( $int_ref_funcionario_exc ) )
        {
            $filtros .= "{$whereAnd} ref_funcionario_exc = '{$int_ref_funcionario_exc}'";
            $whereAnd = " AND ";
        }
        if( is_numeric( $int_ref_funcionario_cad ) )
        {
            $filtros .= "{$whereAnd} ref_funcionario_cad = '{$int_ref_funcionario_cad}'";
            $whereAnd = " AND ";
        }
        if( is_string( $str_nm_software ) )
        {
            $filtros .= "{$whereAnd} nm_software LIKE '%{$str_nm_software}%'";
            $whereAnd = " AND ";
        }
        if( is_string( $date_data_cadastro_ini ) )
        {
            $filtros .= "{$whereAnd} data_cadastro >= '{$date_data_cadastro_ini}'";
            $whereAnd = " AND ";
        }
        if( is_string( $date_data_cadastro_fim ) )
        {
            $filtros .= "{$whereAnd} data_cadastro <= '{$date_data_cadastro_fim}'";
            $whereAnd = " AND ";
        }
        if( is_string( $date_data_exclusao_ini ) )
        {
            $filtros .= "{$whereAnd} data_exclusao >= '{$date_data_exclusao_ini}'";
            $whereAnd = " AND ";
        }
        if( is_string( $date_data_exclusao_fim ) )
        {
            $filtros .= "{$whereAnd} data_exclusao <= '{$date_data_exclusao_fim}'";
            $whereAnd = " AND ";
        }
        if( ! is_null( $bool_ativo ) )
        {
            if( dbBool( $bool_ativo ) )
            {
                $filtros .= "{$whereAnd} ativo = TRUE";
            }
            else
            {
                $filtros .= "{$whereAnd} ativo = FALSE";
            }
            $whereAnd = " AND ";
        }


        $db = new clsBanco();
        $countCampos = count( explode( ",", $this->_campos_lista ) );
        $resultado = array();

        $sql .= $filtros . $this->getOrderby() . $this->getLimite();

        $this->_total = $db->CampoUnico( "SELECT COUNT(0) FROM {$this->_tabela} {$filtros}" );

        $db->Consulta( $sql );

        if( $countCampos > 1 )
        {
            while ( $db->ProximoRegistro() )
            {
                $tupla = $db->Tupla();

                $tupla["_total"] = $this->_total;
                $resultado[] = $tupla;
            }
        }
        else
        {
            while ( $db->ProximoRegistro() )
            {
                $tupla = $db->Tupla();
                $resultado[] = $tupla[$this->_campos_lista];
            }
        }
        if( count( $resultado ) )
        {
            return $resultado;
        }
        return false;
    }

    /**
     * Retorna um array com os dados de um registro
     *
     * @return array
     */
    function detalhe()
    {
        if( is_numeric( $this->cod_software ) )
        {

            $db = new clsBanco();
            $db->Consulta( "SELECT {$this->_todos_campos} FROM {$this->_tabela} WHERE cod_software = '{$this->cod_software}'" );
            $db->ProximoRegistro();
            return $db->Tupla();
        }
        return false;
    }

    /**
     * Retorna true se o registro existir. Caso contrário retorna false.
     *
     * @return bool
     */
    function existe()
    {
        if( is_numeric( $this->cod_software ) )
        {

            $db = new clsBanco();
            $db->Consulta( "SELECT 1 FROM {$this->_tabela} WHERE cod_software = '{$this->cod_software}'" );
            if( $db->ProximoRegistro() )
            {
                return true;
            }
        }
        return false;
    }

    /**
     * Exclui um registro
     *
     * @return bool
     */
    function excluir()
    {
        if( is_numeric( $this->cod_software ) && is_numeric( $this->ref_funcionario_exc ) )
        {

        /*
            delete
        $db = new clsBanco();
        $db->Consulta( "DELETE FROM {$this->_tabela} WHERE cod_software = '{$this->cod_software}'" );
        return true;
        */

        $this->ativo = 0;
            return $this->edita();
        }
        return false;
    }

    /**
     * Define quais campos da tabela serao selecionados na invocacao do metodo lista
     *
     * @return null
     */
    function setCamposLista( $str_campos )
    {
        $this->_campos_lista = $str_campos;
    }

    /**
     * Define que o metodo Lista devera retornoar todos os campos da tabela
     *
     * @return null
     */
    function resetCamposLista()
    {
        $this->_campos_lista = $this->_todos_campos;
    }

    /**
     * Define limites de retorno para o metodo lista
     *
     * @return null
     */
    function setLimite( $intLimiteQtd, $intLimiteOffset = null )
    {
        $this->_limite_quantidade = $intLimiteQtd;
        $this->_limite_offset = $intLimiteOffset;
    }

    /**
     * Retorna a string com o trecho da query resposavel pelo Limite de registros
     *
     * @return string
     */
    function getLimite()
    {
        if( is_numeric( $this->_limite_quantidade ) )
        {
            $retorno = " LIMIT {$this->_limite_quantidade}";
            if( is_numeric( $this->_limite_offset ) )
            {
                $retorno .= " OFFSET {$this->_limite_offset} ";
            }
            return $retorno;
        }
        return "";
    }

    /**
     * Define campo para ser utilizado como ordenacao no metolo lista
     *
     * @return null
     */
    function setOrderby( $strNomeCampo )
    {
        // limpa a string de possiveis erros (delete, insert, etc)
        //$strNomeCampo = eregi_replace();

        if( is_string( $strNomeCampo ) && $strNomeCampo )
        {
            $this->_campo_order_by = $strNomeCampo;
        }
    }

    /**
     * Retorna a string com o trecho da query resposavel pela Ordenacao dos registros
     *
     * @return string
     */
    function getOrderby()
    {
        if( is_string( $this->_campo_order_by ) )
        {
            return " ORDER BY {$this->_campo_order_by} ";
        }
        return "";
    }

}
?>
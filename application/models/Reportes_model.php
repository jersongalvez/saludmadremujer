<?php

class Reportes_model extends CI_model {

   public function  reporteComisionDiario($medico, $fecha){
    $this->db->select("pa.codigo_pago,p.nombre,p.apellido, d.nombre as medico, e.descripcion, pa.tipo_deposito, pa.total, pa.comision, pa.fecha");
    $this->db->from("pagos pa");
    $this->db->join("pacientes p", "pa.dni_paciente = p.documento");
    $this->db->join("doctores d", "pa.medico = d.codigo_doctor");
    $this->db->join("especialidades e", "pa.especialidad = e.codigo_especialidad");
    $this->db->where("pa.medico", $medico);
    $this->db->where("pa.fecha", $fecha);
    $this->db->where("pa.usuario", $this->session->userdata("nombre"));
    $result = $this->db->get();
    
    return $result;
    }

    public function getTotalComisionDiario($medico, $fecha) {
        $this->db->select("SUM(comision) as comision, SUM(total)as total, fecha");
        $this->db->from("pagos");
        $this->db->where("medico", $medico);
        $this->db->where("fecha", $fecha);
        $this->db->where("tipo_deposito", "Efectivo");
        $this->db->where("usuario", $this->session->userdata("nombre"));
        $result = $this->db->get();

    return $result;

    }

    public function reporteGastos($start_date, $end_date) {
        $this->db->select("*");
        $this->db->from("gastos");
        $this->db->where('fecha BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
        $result = $this->db->get();

        return $result;
    }

    public function getTotalGastos($start_date, $end_date) {
        $this->db->select("SUM(precio)as total, fecha");
        $this->db->from("gastos");
        $this->db->where('fecha BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
        $result = $this->db->get();

        return $result;
    }

    public function reporteLaboratorio($usuario, $fecha) {
        $fechaact = date("d-m-Y", strtotime($fecha));
        $this->db->select("d.fecha,d.codigo_pago_laboratorio, l.precio,l.nombre, m.apellido");
        $this->db->from("detalle_pago_laboratorio d");
        $this->db->join("precio_laboratorio l", "d.servicio = l.codigo");
        $this->db->join("laboratorio p", "d.id_laboratorio = p.codigo_laboratorio");
        $this->db->join("pacientes m", "p.dni_paciente = m.documento");
        $this->db->where("d.usuario", $usuario);
        $this->db->where("d.fecha", $fechaact);
        $result = $this->db->get();

        return $result;
    }

    public function totalLaboratorio($usuario, $fecha) {
        $fechaact = date("d-m-Y", strtotime($fecha));
        $this->db->select("SUM(total) as total, fecha");
        $this->db->from("laboratorio");
        $this->db->where("usuario", $usuario);
        $this->db->where("fecha", $fechaact);
        $result = $this->db->get();

        return $result;
    }
    
}

<?php

class T_E_JEUVIDEO_JEUController extends Controller
{
    public function index() {
        $this->render("index", T_E_JEUVIDEO_JEU::findAll());
    }
}
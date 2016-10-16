<?php

namespace ARMACMan\Helpers;


use ARMACMan\Models\Servers;
use xPaw\SourceQuery\SourceQuery;

class ServerHelper {

    private $query;

    public function __construct()
    {
        $this->query = new SourceQuery();
    }

    public function defines(Servers $server) {
        define('SQ_SERVER_ADDR', $server->ip_address);
        define('SQ_SERVER_PORT', $server->query_port);
        define('SQ_TIMEOUT',     3);
        define('SQ_ENGINE',      SourceQuery::SOURCE);
    }

    public function getServerInfo(Servers $server) {
        $this->defines($server);
        try{
            $this->query->Connect( SQ_SERVER_ADDR, SQ_SERVER_PORT, SQ_TIMEOUT, SQ_ENGINE );
            return $this->query->GetInfo();
        } catch( Exception $e ) {
            echo $e->getMessage( );
        } finally {
            $this->query->Disconnect( );
        }
    }

    public function getPlayers(Servers $server) {
        $this->defines($server);
        try{
            $this->query->Connect( SQ_SERVER_ADDR, SQ_SERVER_PORT, SQ_TIMEOUT, SQ_ENGINE );
            return $this->query->GetPlayers();
        } catch( Exception $e ) {
            echo $e->getMessage( );
        } finally {
            $this->query->Disconnect( );
        }
    }

    public function getRules(Servers $server) {
        $this->defines($server);
        try{
            $this->query->Connect( SQ_SERVER_ADDR, SQ_SERVER_PORT, SQ_TIMEOUT, SQ_ENGINE );
            return $this->query->GetRules();
        } catch( Exception $e ) {
            echo $e->getMessage( );
        } finally {
            $this->query->Disconnect( );
        }
    }

}

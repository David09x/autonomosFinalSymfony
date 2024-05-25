<?php

namespace App\Repository;

use App\Entity\Usuarios;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @extends ServiceEntityRepository<Usuarios>
 */
class UsuariosRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    private $contraseñaHaseada;

    public function __construct(ManagerRegistry $registry, UserPasswordHasherInterface $passwordHasher)
    {
        parent::__construct($registry, Usuarios::class);
        $this->contraseñaHaseada = $passwordHasher;
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof Usuarios) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        $user->setPassword($newHashedPassword);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    public function insertarUsuario($idUsuario, $password, $nombreApellido,$token,$roles)
    {
        $connection = $this->getEntityManager()->getConnection();

        try {   
            $body = "INSERT INTO usuarios (idUsuario, password, nombreApellido, roles, token)
                VALUES (:idUsuario, :password, :nombreApellido, :roles, :token)";
            $parameters = ['idUsuario' => $idUsuario,'password' => $password,'nombreApellido' => $nombreApellido,'roles' => $roles,'token' => $token];
    
            $statement = $connection->executeQuery($body,$parameters);
            $results = $statement->fetchAll();
            
            $data = $results;
        } catch (\Exception $e) {
            $data = ['estado' => 'danger'. $e->getMessage()];
        }
    
        return $data;
    }

    public function obtenerToken($idUsuario, $password)
    {
    $connection = $this->getEntityManager()->getConnection();

    try {
        $body = "SELECT token, password FROM usuarios WHERE idUsuario = :idUsuario";
        $parameters = ['idUsuario' => $idUsuario];
        $statement = $connection->executeQuery($body, $parameters);
        $result = $statement->fetchAssociative(); 
        $data =  $result;
          
    } catch (\Exception $e) {
        $data = ['estado' => 'danger'. $e->getMessage()];
    }
    return $data;
    }


}

    



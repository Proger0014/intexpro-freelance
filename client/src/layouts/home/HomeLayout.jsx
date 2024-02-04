import { Header } from "../../components/header";
import { banner as sbanner } from "../../assets/styles";
import { Container, Flex } from "@mantine/core";
import c from "./home.module.scss";
import cn from "classnames";

function HomeLayout({ main, banner }) {
  return (
    <div>
      <div className={sbanner.banner}>
        <Header isTransparent py={29} h="20%" />

        <Container size="xl" h="80%" >
          <Flex align="center" h="100%">
            <div className={sbanner.content}>
              {banner}
            </div>
          </Flex>
        </Container>
      </div>
      <main className={c.dots}>
        <div className={cn(c.cubes, c.cubes_1)}>
          <div className={cn(c.cubes, c.cubes_2)}>
            <Container size="xl">
              {main}
            </Container>
          </div>
        </div>
      </main>
    </div>
  )
}

export default HomeLayout;